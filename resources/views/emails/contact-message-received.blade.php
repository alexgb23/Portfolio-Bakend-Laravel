<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje desde el portfolio</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #2563eb;">Nuevo mensaje desde el portfolio</h1>

    <p><strong>Nombre:</strong> {{ $contactMessage->name }}</p>

    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>

    <p><strong>Asunto:</strong> {{ $contactMessage->subject ?: 'Sin asunto' }}</p>

    <p><strong>Mensaje:</strong></p>
    <div style="background-color: #f3f4f6; padding: 15px; border-radius: 4px; margin: 15px 0;">
        {{ $contactMessage->message }}
    </div>

    <div style="background-color: #e0e7ff; padding: 10px; border-radius: 4px; margin: 15px 0;">
        <strong>Recibido:</strong> {{ $contactMessage->created_at?->format('d/m/Y H:i') }}
    </div>

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 20px 0;">

    <p><strong>Enlaces:</strong></p>
    <ul style="padding-left: 20px;">
        <li>LinkedIn: <a href="https://www.linkedin.com/in/alexander-galvez-benavides-450917281/">https://www.linkedin.com/in/alexander-galvez-benavides-450917281/</a></li>
        <li>GitHub: <a href="https://github.com/alexgb23">https://github.com/alexgb23</a></li>
        <li>Portfolio: <a href="https://alex.syskovex.com">https://alex.syskovex.com</a></li>
        <li>Web: <a href="https://syskovex.com">https://syskovex.com</a></li>
    </ul>

    <div style="margin-top: 25px; background-color: #030712; padding: 12px; width: fit-content; border-radius: 4px;">
        <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png" width="1138" height="349" style="display: block; width: 100%; max-width: 1138px; height: auto;" alt="Alexander Galvez - Syskovex">
    </div>
</body>

</html>