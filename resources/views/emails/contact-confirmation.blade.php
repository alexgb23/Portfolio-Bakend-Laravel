<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Gracias por contactar</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #2563eb;">¡Hola, {{ $contactMessage->name }}!</h1>

    <p>Gracias por ponerte en contacto conmigo a través de mi portfolio web.</p>

    <p>He recibido tu mensaje correctamente sobre el asunto: <strong>"{{ $contactMessage->subject ?: 'Consulta Profesional' }}"</strong>. Lo revisaré detenidamente y te responderé lo antes posible.</p>

    <p>Mientras tanto, te invito a seguir de cerca mi trabajo y conectar conmigo a través de mis redes oficiales:</p>

    <p>
        <a href="https://www.linkedin.com/in/alexander-galvez-benavides-450917281/" style="display: inline-block; padding: 10px 20px; background-color: #0077b5; color: white; text-decoration: none; border-radius: 4px; margin: 5px;">Ver Perfil en LinkedIn</a>
        <a href="https://github.com/alexgb23" style="display: inline-block; padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 4px; margin: 5px;">Explorar Proyectos en GitHub</a>
        <a href="https://alex.syskovex.com" style="display: inline-block; padding: 10px 20px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 4px; margin: 5px;">Ver Portfolio Profesional</a>
        <a href="https://syskovex.com" style="display: inline-block; padding: 10px 20px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 4px; margin: 5px;">Sitio Web Oficial</a>
    </p>

    <p>Un cordial saludo,</p>

    <p><strong>Alex | Syskovex</strong><br>
        <em>Infrastructure & System Engineer</em>
    </p>

    <div style="margin-top: 25px; background-color: #030712; padding: 12px; width: fit-content; border-radius: 4px;">
        <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png" width="1138" height="349" style="display: block; width: 100%; max-width: 1138px; height: auto;" alt="Alexander Galvez - Syskovex">
    </div>
</body>

</html>