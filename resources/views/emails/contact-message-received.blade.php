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

    ---

    ![Alexander Galvez - Syskovex](https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png)

</x-mail::message>