<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Mail\FacilityRequestDecisionMail;
use App\Models\FacilityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class FacilityRequestController extends Controller
{
    /**
     * Store a newly submitted facility onboarding request (public form).
     */
    public function store(StoreFacilityRequest $request): RedirectResponse
    {
        FacilityRequest::create($request->validated());

        Log::info('New facility request submitted.', [
            'facility_name' => $request->validated()['facility_name'],
            'email' => $request->validated()['email'],
        ]);

        return redirect()
            ->route('request.create')
            ->with('status', 'Thank you! Your request has been received. Our team will reach out to you shortly.');
    }

    /**
     * Show the admin dashboard with request statistics.
     */
    public function dashboard(): View
    {
        $stats = [
            'total' => FacilityRequest::count(),
            'pending' => FacilityRequest::where('status', 'pending')->count(),
            'reviewing' => FacilityRequest::where('status', 'reviewing')->count(),
            'approved' => FacilityRequest::where('status', 'approved')->count(),
            'denied' => FacilityRequest::where('status', 'denied')->count(),
        ];

        $recentRequests = FacilityRequest::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentRequests'));
    }

    /**
     * Display a listing of facility requests (admin, protected).
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();
        $region = $request->string('region')->toString();
        $status = $request->string('status')->toString();

        $facilityRequests = FacilityRequest::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('facility_name', 'like', "%{$search}%")
                        ->orWhere('region', 'like', "%{$search}%")
                        ->orWhere('contact_name', 'like', "%{$search}%");
                });
            })
            ->when($region, fn ($query, $region) => $query->where('region', $region))
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $regions = FacilityRequest::query()->distinct()->orderBy('region')->pluck('region');

        return view('requests.index', compact('facilityRequests', 'regions'));
    }

    /**
     * Show the form for editing a facility request (admin, protected).
     */
    public function edit(FacilityRequest $facilityRequest): View
    {
        return view('requests.edit', compact('facilityRequest'));
    }

    /**
     * Update a facility request's status/details (admin, protected).
     */
    public function update(UpdateFacilityRequest $request, FacilityRequest $facilityRequest): RedirectResponse
    {
        $previousStatus = $facilityRequest->status;

        $facilityRequest->update($request->validated());

        Log::info('Facility request updated.', [
            'facility_request_id' => $facilityRequest->id,
            'status' => $facilityRequest->status,
            'updated_by' => $request->user()->email,
        ]);

        $decisionJustMade = $previousStatus !== $facilityRequest->status
            && in_array($facilityRequest->status, ['approved', 'denied']);

        $emailSent = false;

        if ($decisionJustMade) {
            try {
                Mail::to($facilityRequest->email)->send(new FacilityRequestDecisionMail($facilityRequest));

                Log::info('Facility request decision email sent.', [
                    'facility_request_id' => $facilityRequest->id,
                    'status' => $facilityRequest->status,
                    'to' => $facilityRequest->email,
                ]);

                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error('Failed to send facility request decision email.', [
                    'facility_request_id' => $facilityRequest->id,
                    'to' => $facilityRequest->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $message = match (true) {
            $emailSent => "{$facilityRequest->facility_name}'s request has been {$facilityRequest->status}. A notification email was sent to {$facilityRequest->email}.",
            $decisionJustMade => "{$facilityRequest->facility_name}'s request has been {$facilityRequest->status}, but the notification email could not be sent.",
            default => 'Request updated successfully.',
        };

        return redirect()
            ->route('facility-requests.index')
            ->with('status', $message);
    }

    /**
     * Remove a facility request (admin, protected).
     */
    public function destroy(FacilityRequest $facilityRequest): RedirectResponse
    {
        Log::warning('Facility request deleted.', [
            'facility_request_id' => $facilityRequest->id,
            'facility_name' => $facilityRequest->facility_name,
        ]);

        $facilityRequest->delete();

        return redirect()
            ->route('facility-requests.index')
            ->with('status', 'Request deleted successfully.');
    }
}
