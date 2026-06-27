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

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        try {
            // Cambiado ->send() por ->sendNow() para saltarse cualquier cola obligatoriamente
            Mail::to('alexandergalvez880208@gmail.com')
                ->sendNow(new ContactMessageReceived($contactMessage));

        } catch (\Throwable $e) {
            // Si el SMTP falla, Render lo registrará aquí sin congelar el Front eternamente
            Log::error('Mail failed in production', [
                'contact_message_id' => $contactMessage->id,
                'error' => $e->getMessage(),
                'class' => get_class($e),
            ]);

            // Opcional: Puedes avisar al front que se guardó pero el mail falló
            return response()->json([
                'message' => 'Mensaje guardado, pero hubo un problema al enviar la notificación por correo.',
                'data' => [
                    'id' => $contactMessage->id,
                    'status' => $contactMessage->status,
                ],
            ], 201);
        }

        return response()->json([
            'message' => 'Mensaje enviado correctamente',
            'data' => [
                'id' => $contactMessage->id,
                'status' => $contactMessage->status,
            ],
        ], 201);
    }
}
