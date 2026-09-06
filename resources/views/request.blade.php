@extends('layouts.app')

@section('title', 'Request VTrack for Your Facility - ' . config('app.name', 'VTrack'))
@section('description', 'Request the VTrack visitor management system for your BJMP facility.')

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
            <div class="request-card">

                <form class="request-form">

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="facility_name">Facility Name</label>
                            <input class="request-input" type="text" id="facility_name" name="facility_name"
                                   placeholder="e.g. Legazpi City Jail" required>
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="region">Region / Province</label>
                            <input class="request-input" type="text" id="region" name="region"
                                   placeholder="e.g. Region V - Albay" required>
                        </div>
                    </div>

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="contact_name">Contact Person</label>
                            <input class="request-input" type="text" id="contact_name" name="contact_name"
                                   placeholder="Full name" required>
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="position">Position / Rank</label>
                            <input class="request-input" type="text" id="position" name="position"
                                   placeholder="e.g. Jail Officer" required>
                        </div>
                    </div>

                    <div class="request-row">
                        <div class="request-field">
                            <label class="request-label" for="contact_number">Contact Number</label>
                            <input class="request-input" type="tel" id="contact_number" name="contact_number"
                                   placeholder="09XXXXXXXXX" required>
                        </div>
                        <div class="request-field">
                            <label class="request-label" for="email">Email Address</label>
                            <input class="request-input" type="email" id="email" name="email"
                                   placeholder="you@bjmp.gov.ph" required>
                        </div>
                    </div>

                    <div class="request-field request-field--full">
                        <label class="request-label" for="message">Additional Details</label>
                        <textarea class="request-textarea" id="message" name="message" rows="4"
                                  placeholder="Share any details that would help us plan your facility's setup."></textarea>
                    </div>

                    <button type="submit" class="request-submit">Submit Request</button>

                </form>

            </div>
        </section>

@endsection
