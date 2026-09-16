<x-mail::message>
@if ($facilityRequest->status === 'approved')
# Your VTrack Request Has Been Approved

Hello {{ $facilityRequest->contact_name }},

Good news! Your request to bring VTrack to **{{ $facilityRequest->facility_name }}** has been **approved** by the VTrack team.

Our team will reach out to you at {{ $facilityRequest->contact_number }} or this email address to coordinate the next steps for setup.
@else
# Update on Your VTrack Request

Hello {{ $facilityRequest->contact_name }},

We've reviewed your request to bring VTrack to **{{ $facilityRequest->facility_name }}**, and unfortunately we're unable to move forward with it at this time.

If you have questions about this decision, feel free to reach out to us directly.
@endif

<x-mail::button :url="url('/request')">
Visit VTrack
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
