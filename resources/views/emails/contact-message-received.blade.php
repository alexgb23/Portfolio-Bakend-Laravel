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

    **Enlaces del remitente:**

    - LinkedIn: [Alexander Galvez](https://www.linkedin.com/in/alexander-galvez-benavides-450917281/)
    - GitHub: [alexgb23](https://github.com/alexgb23)
    - Portfolio: [alex.syskovex.com](https://alex.syskovex.com)
    - Web: [syskovex.com](https://syskovex.com)

    <div style="margin-top: 25px; margin-bottom: 10px; background-color: #030712; padding: 12px; width: fit-content; border-radius: 4px;">
        <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png"
            width="1138"
            height="349"
            style="display: block; width: 1138px; max-width: 100%; height: auto;"
            alt="Alexander Galvez - Syskovex">
    </div>

</x-mail::message>