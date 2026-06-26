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

        try {
            Log::info('Antes de Mail::send', ['contact_message_id' => $message->id]);
            Mail::to('alexandergalvez880208@gmail.com')
                ->send(new ContactMessageReceived($message));
            Log::info('Despues de Mail::send', ['contact_message_id' => $message->id]);
        } catch (\Throwable $e) {
            Log::error('Error enviando correo de contacto', [
                'contact_message_id' => $message->id,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'message' => 'Mensaje guardado, pero el correo falló.',
                'error' => $e->getMessage(),
                'exception' => get_class($e),
            ], 500);
        }

        return response()->json([
            'message' => 'Mensaje enviado correctamente',
            'data' => [
                'id' => $message->id,
                'status' => $message->status,
                'mail_sent' => true,
            ],
        ], 201);
    }
}
