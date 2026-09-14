<x-mail::message>
    # ¡Hola, {{ $contactMessage->name }}!

    Gracias por ponerte en contacto conmigo a través de mi portfolio web.

    He recibido tu mensaje correctamente sobre el asunto: **"{{ $contactMessage->subject ?: 'Consulta Profesional' }}"**. Lo revisaré detenidamente y te responderé lo antes posible.

    Mientras tanto, te invito a seguir de cerca mi trabajo y conectar conmigo a través de mis redes oficiales:

    <x-mail::button :url="'https://www.linkedin.com/in/alexander-galvez-benavides-450917281/'" color="primary">
        Ver Perfil en LinkedIn
    </x-mail::button>

    <x-mail::button :url="'https://github.com/alexgb23'" color="success">
        Explorar Proyectos en GitHub
    </x-mail::button>

    <x-mail::button :url="'https://alex.syskovex.com'" color="blue">
        Ver Portfolio Profesional
    </x-mail::button>

    <x-mail::button :url="'https://syskovex.com'" color="gray">
        Sitio Web Oficial
    </x-mail::button>

    Un cordial saludo,

    **Alex | Syskovex**
    *Infrastructure & System Engineer*

    <div style="margin-top: 25px; margin-bottom: 10px; background-color: #030712; padding: 12px; width: fit-content; border-radius: 4px;">
        <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png"
            width="1138"
            height="349"
            style="display: block; width: 1138px; max-width: 100%; height: auto;"
            alt="Alexander Galvez - Syskovex">
    </div>

</x-mail::message>