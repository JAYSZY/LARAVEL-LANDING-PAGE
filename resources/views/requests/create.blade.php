@extends('layouts.site')


@section('content')

        <section class="request-hero">
            <div class="request-hero__inner">
                <h1 class="request-hero__title">Request VTrack for Your Facility</h1>

                <div class="request-hero__divider">
                    <span class="request-hero__divider-line"></span>
                    <x-heroicon-s-star class="request-hero__divider-icon" />
                    <span class="request-hero__divider-line"></span>
                </div>

                <p class="request-hero__desc">
                    Interested in bringing VTrack to your own BJMP facility or office? Fill out the
                    form below and our team will reach out to help you get started.
                </p>
            </div>
        </section>

        <section class="request-page">

            @if (session('status'))
                <div class="request-status">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="request-status request-status--error">
                    Please correct the errors below and try again.
                </div>
            @endif

            <div class="request-card">

                <form class="request-form" method="POST" action="{{ route('request.store') }}">
                    @csrf

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="facility_name">Facility Name</label>
                            <input class="request-input @error('facility_name') request-input--invalid @enderror"
                                   type="text" id="facility_name" name="facility_name"
                                   value="{{ old('facility_name') }}"
                                   placeholder="e.g. Legazpi City Jail" required>
                            @error('facility_name')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="region">Region / Province</label>
                            <input class="request-input @error('region') request-input--invalid @enderror"
                                   type="text" id="region" name="region"
                                   value="{{ old('region') }}"
                                   placeholder="e.g. Region V - Albay" required>
                            @error('region')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="contact_name">Contact Person</label>
                            <input class="request-input @error('contact_name') request-input--invalid @enderror"
                                   type="text" id="contact_name" name="contact_name"
                                   value="{{ old('contact_name') }}"
                                   placeholder="Full name" required>
                            @error('contact_name')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="position">Position / Rank</label>
                            <input class="request-input @error('position') request-input--invalid @enderror"
                                   type="text" id="position" name="position"
                                   value="{{ old('position') }}"
                                   placeholder="e.g. Jail Officer" required>
                            @error('position')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="contact_number">Contact Number</label>
                            <input class="request-input @error('contact_number') request-input--invalid @enderror"
                                   type="tel" id="contact_number" name="contact_number"
                                   value="{{ old('contact_number') }}"
                                   placeholder="09XXXXXXXXX" required>
                            @error('contact_number')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="email">Email Address</label>
                            <input class="request-input @error('email') request-input--invalid @enderror"
                                   type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="you@bjmp.gov.ph" required>
                            @error('email')
                                <p class="request-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="request-field request-field--full">
                        <label class="request-label" for="message">Additional Details</label>
                        <textarea class="request-textarea @error('message') request-textarea--invalid @enderror"
                                  id="message" name="message" rows="4"
                                  placeholder="Share any details that would help us plan your facility's setup.">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="request-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="request-submit">Submit Request</button>

                </form>

            </div>
        </section>

@endsection
