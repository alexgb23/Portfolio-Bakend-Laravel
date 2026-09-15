<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationSent extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✉️ Gracias por contactar con Alexander Gálvez',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation', // Cambiado de 'markdown' a 'view'
            with: [
                'contactMessage' => $this->contactMessage,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
