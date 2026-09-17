<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Gracias por contactar</title>

    <style>
        :root {
            color-scheme: light dark;
        }

        body,
        .email-body {
            background-color: #f4f7fb !important;
            color: #26364a !important;
        }

        .email-card {
            background-color: #ffffff !important;
            border-color: #d9e2ec !important;
        }

        .email-muted {
            color: #5d6b7a !important;
        }

        .email-main-text {
            color: #344457 !important;
        }

        .email-heading,
        .email-strong {
            color: #1d2b3a !important;
        }

        .email-panel {
            background-color: #eef3f8 !important;
            border-color: #d9e2ec !important;
        }

        .email-border {
            border-color: #d9e2ec !important;
        }

        @media (prefers-color-scheme: dark) {

            body,
            .email-body {
                background-color: #050912 !important;
                color: #d4dce5 !important;
            }

            .email-card {
                background-color: #080e18 !important;
                border-color: #1d3048 !important;
            }

            .email-muted {
                color: #aeb9c6 !important;
            }

            .email-main-text {
                color: #cbd5e1 !important;
            }

            .email-heading,
            .email-strong {
                color: #f1f5f9 !important;
            }

            .email-panel {
                background-color: #0d1624 !important;
                border-color: #1d3048 !important;
            }

            .email-border {
                border-color: #1d3048 !important;
            }
        }

        @media screen and (max-width: 680px) {
            .email-card-content {
                padding: 20px 17px !important;
            }

            .email-title {
                font-size: 24px !important;
                line-height: 30px !important;
            }
        }
    </style>
</head>

<body class="email-body" style="margin:0; padding:0; background-color:#f4f7fb; color:#26364a; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-body" style="width:100%; margin:0; padding:0; background-color:#f4f7fb;">
        <tr>
            <td align="center" style="padding:12px 8px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-card" style="width:100%; max-width:680px; background-color:#ffffff; border:1px solid #d9e2ec; border-radius:14px; overflow:hidden;">
                    <tr>
                        <td style="height:4px; background-color:#0d5fc2; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="email-card-content" style="padding:24px 26px 20px;">
                            <p class="email-heading" style="margin:0; color:#1d2b3a; font-size:15px; font-weight:700; line-height:22px;">
                                Alex · Syskovex
                            </p>

                            <p class="email-muted" style="margin:0 0 16px; color:#5d6b7a; font-size:13px; font-style:italic; line-height:20px;">
                                Técnico IT · Infraestructura, sistemas y automatización
                            </p>

                            <h1 class="email-title email-heading" style="margin:0 0 12px; color:#1d2b3a; font-size:28px; font-weight:700; line-height:34px;">
                                ¡Hola, {{ $contactMessage->name }}!
                            </h1>

                            <p class="email-main-text" style="margin:0 0 10px; color:#344457; font-size:16px; line-height:25px;">
                                Gracias por ponerte en contacto conmigo a través de mi portfolio web.
                            </p>

                            <p class="email-main-text" style="margin:0; color:#344457; font-size:16px; line-height:25px;">
                                He recibido correctamente tu mensaje sobre
                                <strong class="email-strong" style="color:#1d2b3a;">
                                    “{{ $contactMessage->subject ?: 'Consulta profesional' }}”
                                </strong>.
                                Lo revisaré detenidamente y te responderé lo antes posible.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; margin:16px 0;">
                                <tr>
                                    <td class="email-panel" style="padding:14px; background-color:#eef3f8; border:1px solid #d9e2ec; border-radius:10px;">
                                        <p class="email-muted" style="margin:0 0 4px; color:#5d6b7a; font-size:14px; font-weight:700; line-height:20px;">
                                            Mientras tanto
                                        </p>

                                        <p class="email-main-text" style="margin:0; color:#344457; font-size:14px; line-height:22px;">
                                            Puedes conocer mejor mi trabajo, proyectos y servicios desde mis enlaces oficiales.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
                                <tr>
                                    <td style="padding:0 0 7px;">
                                        <a href="https://www.linkedin.com/in/alexander-galvez-benavides-450917281/" target="_blank" style="display:block; padding:11px 18px; background-color:#0d5fc2; border:1px solid #246fc8; border-radius:8px; color:#ffffff; font-size:14px; font-weight:700; line-height:20px; text-align:center; text-decoration:none;">
                                            Ver perfil en LinkedIn&nbsp; →
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 0 7px;">
                                        <a href="https://github.com/alexgb23" target="_blank" style="display:block; padding:11px 18px; background-color:#0d5fc2; border:1px solid #246fc8; border-radius:8px; color:#ffffff; font-size:14px; font-weight:700; line-height:20px; text-align:center; text-decoration:none;">
                                            Explorar proyectos en GitHub&nbsp; →
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 0 7px;">
                                        <a href="https://alex.syskovex.com" target="_blank" style="display:block; padding:11px 18px; background-color:#0d5fc2; border:1px solid #246fc8; border-radius:8px; color:#ffffff; font-size:14px; font-weight:700; line-height:20px; text-align:center; text-decoration:none;">
                                            Ver portfolio profesional&nbsp; →
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="https://syskovex.com" target="_blank" style="display:block; padding:11px 18px; background-color:#0d5fc2; border:1px solid #246fc8; border-radius:8px; color:#ffffff; font-size:14px; font-weight:700; line-height:20px; text-align:center; text-decoration:none;">
                                            Visitar Syskovex&nbsp; →
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-top:10px;">
                                <tr>
                                    <td align="left" style="padding:0;">
                                        <img src="https://syskovex.com/images/Tarjeta_FirmaDigital_Mail.png" width="632" alt="Alexander Galvez - Syskovex" style="display:block; width:100%; max-width:632px; height:auto; border:0; outline:none; text-decoration:none;">
                                        <span style="display:block; width:1px; height:1px; max-height:1px; overflow:hidden; color:transparent; font-size:1px; line-height:1px;">
                                            Ref: {{ $contactMessage->id }}-{{ $contactMessage->created_at?->timestamp }}
                                        </span>
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