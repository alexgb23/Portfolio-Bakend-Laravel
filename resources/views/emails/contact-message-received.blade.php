<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje desde el portfolio</title>
</head>

<body style="margin:0; padding:0; background-color:#050912; color:#f1f5f9; font-family:Arial, Helvetica, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
        style="width:100%; margin:0; padding:0; background-color:#050912;">
        <tr>
            <td align="center" style="padding:32px 16px;">

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="width:100%; max-width:600px; background-color:#080e18; border:1px solid #1d3048; border-radius:14px;">

                    <tr>
                        <td style="height:4px; background-color:#0d5fc2; font-size:0; line-height:0;">
                            &nbsp;
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:36px 32px 32px;">

                            <p style="margin:0 0 10px; color:#7fb3ff; font-size:12px; font-weight:700; line-height:18px; letter-spacing:1px; text-transform:uppercase;">
                                Alex | Portfolio
                            </p>

                            <h1 style="margin:0 0 24px; color:#f1f5f9; font-size:28px; font-weight:700; line-height:34px;">
                                Nuevo mensaje desde el portfolio
                            </h1>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="width:100%; background-color:#0d1624; border:1px solid #1d3048; border-radius:10px;">
                                <tr>
                                    <td style="padding:20px;">

                                        <p style="margin:0 0 14px; color:#e0e7ff; font-size:14px; line-height:22px;">
                                            <strong style="display:inline-block; width:76px; color:#bec8fa;">
                                                Nombre
                                            </strong>

                                            <span style="color:#f1f5f9;">
                                                {{ $contactMessage->name }}
                                            </span>
                                        </p>

                                        <p style="margin:0 0 14px; color:#e0e7ff; font-size:14px; line-height:22px;">
                                            <strong style="display:inline-block; width:76px; color:#bec8fa;">
                                                Email
                                            </strong>

                                            <a href="mailto:{{ $contactMessage->email }}"
                                                style="color:#7fb3ff; text-decoration:underline;">
                                                {{ $contactMessage->email }}
                                            </a>
                                        </p>

                                        <p style="margin:0; color:#e0e7ff; font-size:14px; line-height:22px;">
                                            <strong style="display:inline-block; width:76px; color:#bec8fa;">
                                                Asunto
                                            </strong>

                                            <span style="color:#f1f5f9;">
                                                {{ $contactMessage->subject ?: 'Sin asunto' }}
                                            </span>
                                        </p>

                                    </td>
                                </tr>
                            </table>

                            <p style="margin:28px 0 10px; color:#bec8fa; font-size:13px; font-weight:700; line-height:20px; letter-spacing:0.8px; text-transform:uppercase;">
                                Mensaje
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="width:100%; background-color:#101c2c; border:1px solid #2a4567; border-radius:10px;">
                                <tr>
                                    <td style="padding:20px; color:#f1f5f9; font-size:15px; line-height:24px; white-space:pre-wrap;">
                                        {{ $contactMessage->message }}
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="width:100%; margin-top:18px; background-color:#0d1624; border:1px solid #1d3048; border-radius:8px;">
                                <tr>
                                    <td style="padding:13px 16px; color:#e0e7ff; font-size:13px; line-height:20px;">
                                        <strong style="color:#5eea7a;">Recibido</strong>
                                        <span> · {{ $contactMessage->created_at?->format('d/m/Y H:i') }}</span>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>