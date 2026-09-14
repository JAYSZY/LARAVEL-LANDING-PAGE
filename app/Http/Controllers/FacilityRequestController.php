<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\FacilityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
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
            'contacted' => FacilityRequest::where('status', 'contacted')->count(),
            'approved' => FacilityRequest::where('status', 'approved')->count(),
        ];

        $recentRequests = FacilityRequest::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentRequests'));
    }

    /**
     * Display a listing of facility requests (admin, protected).
     */
    public function index(): View
    {
        $facilityRequests = FacilityRequest::latest()->paginate(10);

        return view('requests.index', compact('facilityRequests'));
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
        $facilityRequest->update($request->validated());

        Log::info('Facility request updated.', [
            'facility_request_id' => $facilityRequest->id,
            'status' => $facilityRequest->status,
            'updated_by' => $request->user()->email,
        ]);

        return redirect()
            ->route('facility-requests.index')
            ->with('status', 'Request updated successfully.');
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
