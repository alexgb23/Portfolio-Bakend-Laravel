<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $message = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        $mailSent = false;

        try {
            Mail::to('alexandergalvez880208@gmail.com')
                ->send(new ContactMessageReceived($message));

            $mailSent = true;
        } catch (\Throwable $e) {
            Log::error('Error enviando correo de contacto', [
                'contact_message_id' => $message->id,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'message' => $mailSent
                ? 'Mensaje enviado correctamente'
                : 'Mensaje guardado correctamente. El correo no pudo enviarse en este momento.',
            'data' => [
                'id' => $message->id,
                'status' => $message->status,
                'mail_sent' => $mailSent,
            ],
        ], 201);
    }
}
