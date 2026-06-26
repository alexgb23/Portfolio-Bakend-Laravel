<x-mail::message>
# Nuevo mensaje desde el portfolio

**Nombre:** {{ $contactMessage->name }}

**Email:** {{ $contactMessage->email }}

**Asunto:** {{ $contactMessage->subject ?: 'Sin asunto' }}

**Mensaje:**

{{ $contactMessage->message }}

<x-mail::panel>
Recibido: {{ $contactMessage->created_at?->format('d/m/Y H:i') }}
</x-mail::panel>
</x-mail::message>
