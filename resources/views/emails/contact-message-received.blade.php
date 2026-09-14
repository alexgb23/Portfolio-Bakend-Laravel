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

    ---

    **Enlaces:**

    - LinkedIn: https://www.linkedin.com/in/alexander-galvez-benavides-450917281/
    - GitHub: https://github.com/alexgb23
    - Portfolio: https://alex.syskovex.com
    - Web: https://syskovex.com

    <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png" width="1138" height="349" style="max-width: 100%; height: auto;" alt="Alexander Galvez - Syskovex">

</x-mail::message>