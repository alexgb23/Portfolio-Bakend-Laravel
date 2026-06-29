<x-mail::message>
    # ¡Hola, {{ $contactMessage->name }}!

    Gracias por ponerte en contacto conmigo a través de mi portfolio web.

    He recibido tu mensaje correctamente sobre el asunto: **"{{ $contactMessage->subject ?: 'Consulta Profesional' }}"**. Lo revisaré detenidamente y te responderé lo antes posible.

    Mientras tanto, te invito a seguir de cerca mi trabajo y conectar conmigo a través de mis redes oficiales:

    <div style="text-align: center; margin: 25px 0;">
        <a href="https://linkedin.com" target="_blank" style="background-color: #2563eb; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold; margin: 5px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
            Ver Perfil en LinkedIn
        </a>
        <a href="https://github.com" target="_blank" style="background-color: #1f2937; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold; margin: 5px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
            Explorar Proyectos en GitHub
        </a>
    </div>

    Un cordial saludo,

    **Alex | Syskovex**
    *Infrastructure & System Engineer*
    [alex.syskovex.com](https://alex.syskovex.com)
    *Barakaldo, País Vasco, España*
</x-mail::message>