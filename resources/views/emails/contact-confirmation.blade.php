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

Un cordial saludo,

**Alex | Syskovex**
*Infrastructure & System Engineer*
[alex.syskovex.com](https://alex.syskovex.com)
*Barakaldo, País Vasco, España*
</x-mail::message>
