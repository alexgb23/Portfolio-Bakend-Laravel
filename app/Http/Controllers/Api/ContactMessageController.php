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

        dispatch(function () use ($contactMessage) {
            try {
                Mail::to('alexandergalvez880208@gmail.com')
                    ->send(new ContactMessageReceived($contactMessage));
            } catch (\Throwable $e) {
                Log::error('Mail failed after response', [
                    'contact_message_id' => $contactMessage->id,
                    'error' => $e->getMessage(),
                    'class' => get_class($e),
                ]);
            }
        })->afterResponse();

        return response()->json([
            'message' => 'Mensaje enviado correctamente',
            'data' => [
                'id' => $contactMessage->id,
                'status' => $contactMessage->status,
                'mail_sent' => false,
                'mail_queued_after_response' => true,
            ],
        ], 201);
    }
}
