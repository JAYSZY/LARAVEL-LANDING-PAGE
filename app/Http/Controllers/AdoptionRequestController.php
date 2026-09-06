<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdoptionRequestController extends Controller
{
    public function create(): View
    {
        return view('adoption-request');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'facility_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        AdoptionRequest::create($validated);

        return redirect()
            ->route('adoption-request.create')
            ->with('status', 'Thank you! Your request has been submitted. Our team will get in touch with you soon.');
    }
}
