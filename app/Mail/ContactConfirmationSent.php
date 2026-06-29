<?php

namespace App\Mail;

use App\Models\ContactMessage; // 🌟 IMPORTANTE: Importamos el modelo
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

    // 🌟 NUEVO: Declaramos la propiedad pública para la plantilla
    public ContactMessage $contactMessage;

    /**
     * Create a new message instance.
     */
    // 🌟 CORRECCIÓN: Recibimos el mensaje guardado desde el controlador
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✉️ Gracias por contactar con Alexander Gálvez',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-confirmation',
            // 🌟 NUEVO: Pasamos la variable a la vista Markdown
            with: [
                'contactMessage' => $this->contactMessage,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
