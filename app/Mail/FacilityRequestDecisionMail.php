<?php

namespace App\Mail;

use App\Models\FacilityRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacilityRequestDecisionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FacilityRequest $facilityRequest,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match ($this->facilityRequest->status) {
            'approved' => 'Your VTrack Request Has Been Approved',
            'denied' => 'Update on Your VTrack Request',
            default => 'Update on Your VTrack Request',
        };

        return new Envelope(subject: $subject);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.facility-request-decision',
            with: [
                'facilityRequest' => $this->facilityRequest,
            ],
        );
    }
}
