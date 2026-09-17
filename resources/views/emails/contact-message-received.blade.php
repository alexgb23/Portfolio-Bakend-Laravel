<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Nuevo mensaje desde el portfolio</title>

    <style>
        :root {
            color-scheme: light dark;
        }

        body,
        .email-body {
            background-color: #f4f7fb !important;
            color: #344457 !important;
        }

        .email-card {
            background-color: #ffffff !important;
            border-color: #d9e2ec !important;
        }

        .email-label {
            color: #5d6b7a !important;
        }

        .email-heading,
        .email-value {
            color: #1d2b3a !important;
        }

        .email-link {
            color: #1769c2 !important;
        }

        .email-panel {
            background-color: #eef3f8 !important;
            border-color: #d9e2ec !important;
        }

        .email-message {
            background-color: #f7f9fc !important;
            border-color: #cbd8e6 !important;
            color: #26364a !important;
        }

        .email-meta {
            background-color: #eef3f8 !important;
            border-color: #d9e2ec !important;
            color: #5d6b7a !important;
        }

        @media (prefers-color-scheme: dark) {

            body,
            .email-body {
                background-color: #050912 !important;
                color: #cbd5e1 !important;
            }

            .email-card {
                background-color: #080e18 !important;
                border-color: #1d3048 !important;
            }

            .email-label {
                color: #bec8fa !important;
            }

            .email-heading,
            .email-value {
                color: #f1f5f9 !important;
            }

            .email-link {
                color: #7fb3ff !important;
            }

            .email-panel {
                background-color: #0d1624 !important;
                border-color: #1d3048 !important;
            }

            .email-message {
                background-color: #101c2c !important;
                border-color: #2a4567 !important;
                color: #f1f5f9 !important;
            }

            .email-meta {
                background-color: #0d1624 !important;
                border-color: #1d3048 !important;
                color: #e0e7ff !important;
            }
        }

        @media screen and (max-width: 680px) {
            .email-outer-padding {
                padding: 18px 10px !important;
            }

            .email-card-content {
                padding: 26px 20px 24px !important;
            }

            .email-title {
                font-size: 24px !important;
                line-height: 30px !important;
            }

            .email-label-cell {
                display: block !important;
                width: auto !important;
                margin-bottom: 2px !important;
            }
        }
    </style>
</head>

<body class="email-body" style="margin:0; padding:0; background-color:#f4f7fb; color:#344457; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-body" style="width:100%; margin:0; padding:0; background-color:#f4f7fb;">
        <tr>
            <td align="center" class="email-outer-padding" style="padding:32px 16px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-card" style="width:100%; max-width:600px; background-color:#ffffff; border:1px solid #d9e2ec; border-radius:14px;">
                    <tr>
                        <td style="height:4px; background-color:#0d5fc2; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td class="email-card-content" style="padding:36px 32px 32px;">
                            <p class="email-label" style="margin:0 0 10px; color:#5d6b7a; font-size:12px; font-weight:700; line-height:18px; letter-spacing:1px; text-transform:uppercase;">
                                Alex | Portfolio
                            </p>

                            <h1 class="email-title email-heading" style="margin:0 0 24px; color:#1d2b3a; font-size:28px; font-weight:700; line-height:34px;">
                                Nuevo mensaje desde el portfolio
                            </h1>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-panel" style="width:100%; background-color:#eef3f8; border:1px solid #d9e2ec; border-radius:10px;">
                                <tr>
                                    <td style="padding:20px;">
                                        <p class="email-value" style="margin:0 0 14px; color:#1d2b3a; font-size:14px; line-height:22px;">
                                            <strong class="email-label email-label-cell" style="display:inline-block; width:76px; color:#5d6b7a;">Nombre</strong>
                                            <span>{{ $contactMessage->name }}</span>
                                        </p>

                                        <p class="email-value" style="margin:0 0 14px; color:#1d2b3a; font-size:14px; line-height:22px;">
                                            <strong class="email-label email-label-cell" style="display:inline-block; width:76px; color:#5d6b7a;">Email</strong>
                                            <a href="mailto:{{ $contactMessage->email }}" class="email-link" style="color:#1769c2; text-decoration:underline;">{{ $contactMessage->email }}</a>
                                        </p>

                                        <p class="email-value" style="margin:0; color:#1d2b3a; font-size:14px; line-height:22px;">
                                            <strong class="email-label email-label-cell" style="display:inline-block; width:76px; color:#5d6b7a;">Asunto</strong>
                                            <span>{{ $contactMessage->subject ?: 'Sin asunto' }}</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p class="email-label" style="margin:28px 0 10px; color:#5d6b7a; font-size:13px; font-weight:700; line-height:20px; letter-spacing:0.8px; text-transform:uppercase;">
                                Mensaje
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-message" style="width:100%; background-color:#f7f9fc; border:1px solid #cbd8e6; border-radius:10px;">
                                <tr>
                                    <td class="email-message" style="padding:20px; color:#26364a; font-size:15px; line-height:24px; white-space:pre-wrap;">
                                        {{ $contactMessage->message }}
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="email-meta" style="width:100%; margin-top:18px; background-color:#eef3f8; border:1px solid #d9e2ec; border-radius:8px;">
                                <tr>
                                    <td class="email-meta" style="padding:13px 16px; color:#5d6b7a; font-size:13px; line-height:20px;">
                                        <strong style="color:#258a45;">Recibido</strong>
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