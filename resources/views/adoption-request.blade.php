<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Request VTrack - {{ config('app.name', 'VTrack') }}</title>
        <meta name="description" content="Request VTrack, the secure offline-ready visitor management system, for your own facility or office.">

        @fonts

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-body">

        @include('partials.site-header', ['navLabel' => 'Back to Home', 'navHref' => url('/')])

        <section class="request-header">
            <h1 class="request-header__title">Request VTrack for Your Facility</h1>
            <p class="request-header__desc">
                Interested in bringing VTrack to your own BJMP facility or office? Fill out the form
                below and our team will reach out to help you get started.
            </p>
        </section>

        <section class="request-section">
            <div class="form-card">

                @if (session('status'))
                    <p class="form-status">{{ session('status') }}</p>
                @endif

                <form method="POST" action="{{ route('adoption-request.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="facility_name" class="form-label">Facility / Office Name</label>
                        <input type="text" name="facility_name" id="facility_name" class="form-input"
                               value="{{ old('facility_name') }}" required>
                        @error('facility_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_name" class="form-label">Contact Person</label>
                            <input type="text" name="contact_name" id="contact_name" class="form-input"
                                   value="{{ old('contact_name') }}" required>
                            @error('contact_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position" class="form-label">Position / Designation</label>
                            <input type="text" name="position" id="position" class="form-input"
                                   value="{{ old('position') }}">
                            @error('position')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-input"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-input"
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Facility Address</label>
                        <input type="text" name="address" id="address" class="form-input"
                               value="{{ old('address') }}">
                        @error('address')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">Tell us about your facility (optional)</label>
                        <textarea name="message" id="message" rows="4" class="form-textarea">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">Submit Request</button>
                </form>

            </div>
        </section>

        @include('partials.site-footer')

    </body>
</html>
