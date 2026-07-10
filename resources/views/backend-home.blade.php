<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portfolio Backend API') }}</title>
    <meta name="description" content="Backend público del portfolio: API Laravel, documentación OpenAPI, health check y endpoints principales del sistema.">
    <style>
        :root{
            --bg:#0a0f1c;
            --bg-2:#0f172a;
            --panel:#111a2e;
            --panel-2:#16213b;
            --line:#243456;
            --line-2:#31456f;
            --text:#eef4ff;
            --muted:#a7b6d9;
            --soft:#cad6f6;
            --accent:#79f2df;
            --accent-2:#8fb5ff;
            --accent-3:#96a7ff;
            --ok:#42d392;
            --warn:#f3c15d;
            --shadow:0 24px 80px rgba(0,0,0,.34);
            --radius:20px;
            --radius-sm:14px;
            --max:1160px;
        }

        *{box-sizing:border-box}
        html,body{margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at top right, rgba(121,242,223,.10), transparent 26%),
                radial-gradient(circle at top left, rgba(143,181,255,.12), transparent 24%),
                linear-gradient(180deg, #09101d 0%, #0b1324 55%, #0d1628 100%);
            line-height:1.6;
        }

        a{color:inherit;text-decoration:none}
        code{
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            padding:2px 8px;
            border-radius:10px;
            border:1px solid var(--line);
            background:#0d1528;
            color:#dbe8ff;
        }

        .wrap{
            max-width:var(--max);
            margin:0 auto;
            padding:28px 20px 72px;
        }

        .topbar{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:18px;
            padding:10px 0 24px;
            color:var(--muted);
            font-size:.95rem;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            min-width:0;
        }

        .brand-mark{
            width:42px;
            height:42px;
            border-radius:14px;
            display:grid;
            place-items:center;
            font-weight:800;
            color:#07111d;
            background:linear-gradient(135deg, var(--accent), var(--accent-2));
            box-shadow:0 12px 24px rgba(121,242,223,.18);
        }

        .brand-copy{
            display:flex;
            flex-direction:column;
            min-width:0;
        }

        .brand-copy strong{
            font-size:.98rem;
            color:var(--text);
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .brand-copy span{
            font-size:.88rem;
            color:var(--muted);
        }

        .status-pill{
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding:9px 14px;
            border:1px solid var(--line);
            border-radius:999px;
            background:rgba(255,255,255,.03);
            white-space:nowrap;
        }

        .status-dot{
            width:10px;
            height:10px;
            border-radius:999px;
            background:var(--ok);
            box-shadow:0 0 18px rgba(66,211,146,.55);
        }

        .hero{
            position:relative;
            overflow:hidden;
            border:1px solid var(--line);
            border-radius:32px;
            background:
                linear-gradient(180deg, rgba(255,255,255,.03), rgba(255,255,255,.01)),
                rgba(16,24,44,.85);
            box-shadow:var(--shadow);
            padding:34px;
        }

        .hero::before{
            content:"";
            position:absolute;
            inset:auto -60px -90px auto;
            width:240px;
            height:240px;
            border-radius:999px;
            background:radial-gradient(circle, rgba(121,242,223,.18), transparent 70%);
            pointer-events:none;
        }

        .hero-grid{
            display:grid;
            grid-template-columns:1fr;
            gap:28px;
            position:relative;
            z-index:1;
        }

        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:10px;
            width:max-content;
            padding:8px 12px;
            border-radius:999px;
            border:1px solid rgba(121,242,223,.18);
            background:rgba(121,242,223,.08);
            color:var(--accent);
            font-size:.9rem;
            font-weight:600;
        }

        h1{
            margin:16px 0 16px;
            max-width:12ch;
            font-size:clamp(2.4rem, 6vw, 4.8rem);
            line-height:1.02;
            letter-spacing:-.04em;
        }

        .lead{
            margin:0;
            max-width:72ch;
            color:var(--muted);
            font-size:1.06rem;
        }

        .hero-actions{
            display:flex;
            flex-wrap:wrap;
            gap:12px;
            margin-top:24px;
        }

        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            min-height:48px;
            padding:0 16px;
            border-radius:14px;
            border:1px solid var(--line);
            background:rgba(17,26,46,.9);
            color:var(--text);
            font-weight:600;
            transition:transform .18s ease, border-color .18s ease, background .18s ease;
        }

        .btn:hover{
            transform:translateY(-1px);
            border-color:var(--line-2);
            background:rgba(21,33,58,.96);
        }

        .btn.primary{
            border:none;
            color:#07111d;
            background:linear-gradient(135deg, var(--accent), var(--accent-2));
        }

        .btn.primary:hover{
            background:linear-gradient(135deg, #8af5e5, #a2c0ff);
        }

        .hero-panel{
            display:grid;
            gap:12px;
        }

        .hero-card{
            padding:18px;
            border-radius:18px;
            border:1px solid var(--line);
            background:rgba(255,255,255,.025);
        }

        .hero-card span{
            display:block;
            color:var(--muted);
            font-size:.88rem;
            margin-bottom:6px;
        }

        .hero-card strong{
            display:block;
            font-size:1rem;
            color:var(--text);
        }

        .section{
            margin-top:22px;
        }

        .grid{
            display:grid;
            grid-template-columns:repeat(12,1fr);
            gap:16px;
        }

        .card{
            grid-column:span 12;
            border-radius:var(--radius);
            border:1px solid var(--line);
            background:rgba(16,24,44,.82);
            padding:22px;
            box-shadow:0 16px 46px rgba(0,0,0,.18);
        }

        .card h2{
            margin:0 0 12px;
            font-size:1.2rem;
            letter-spacing:-.02em;
        }

        .card h3{
            margin:0 0 10px;
            font-size:1rem;
        }

        .muted{color:var(--muted)}
        .soft{color:var(--soft)}

        .stats{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
            gap:12px;
            margin-top:16px;
        }

        .stat{
            padding:16px;
            border-radius:16px;
            border:1px solid var(--line);
            background:var(--panel-2);
        }

        .stat strong{
            display:block;
            margin-bottom:4px;
            font-size:1.06rem;
        }

        .list{
            list-style:none;
            padding:0;
            margin:0;
            display:grid;
            gap:10px;
        }

        .stack-list li,
        .timeline li{
            padding:12px 14px;
            border-radius:14px;
            border:1px solid var(--line);
            background:var(--panel-2);
            color:var(--soft);
        }

        .endpoint{
            display:grid;
            grid-template-columns:auto 1fr;
            gap:12px;
            align-items:start;
            padding:14px;
            border-radius:16px;
            border:1px solid var(--line);
            background:var(--panel-2);
        }

        .badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-width:58px;
            padding:5px 10px;
            border-radius:999px;
            border:1px solid rgba(121,242,223,.22);
            background:rgba(121,242,223,.08);
            color:var(--accent);
            font-size:.8rem;
            font-weight:800;
        }

        .endpoint-copy{
            display:grid;
            gap:6px;
        }

        .endpoint-copy p{
            margin:0;
            color:var(--muted);
        }

        .quick-links{
            display:grid;
            gap:12px;
        }

        .quick-link{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            padding:14px 16px;
            border-radius:16px;
            border:1px solid var(--line);
            background:var(--panel-2);
            transition:border-color .18s ease, transform .18s ease;
        }

        .quick-link:hover{
            transform:translateY(-1px);
            border-color:var(--line-2);
        }

        .quick-link small{
            color:var(--muted);
            display:block;
            margin-top:4px;
        }

        .mini-note{
            margin-top:14px;
            padding:14px 16px;
            border-radius:16px;
            border:1px solid rgba(243,193,93,.22);
            background:rgba(243,193,93,.08);
            color:#f6deb0;
        }

        footer{
            margin-top:24px;
            color:var(--muted);
            font-size:.95rem;
        }

        @media (min-width: 900px){
            .hero{padding:42px}
            .hero-grid{grid-template-columns:minmax(0, 1.25fr) minmax(320px, .75fr);align-items:end}
            .span-7{grid-column:span 7}
            .span-5{grid-column:span 5}
            .span-6{grid-column:span 6}
        }

        @media (max-width: 640px){
            .wrap{padding:20px 16px 56px}
            .topbar{flex-direction:column;align-items:flex-start}
            .hero{padding:24px}
            h1{max-width:unset}
            .endpoint{grid-template-columns:1fr}
        }
    </style>
</head>
<body>
    <main class="wrap">
        <div class="topbar">
            <div class="brand">
                <div class="brand-mark">API</div>
                <div class="brand-copy">
                    <strong>{{ config('app.name', 'Portfolio Backend API') }}</strong>
                    <span>Laravel · documentación pública · base técnica del portfolio</span>
                </div>
            </div>

            <div class="status-pill">
                <span class="status-dot"></span>
                Servicio operativo
            </div>
        </div>

        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Backend público del portfolio</div>

                    <h1>API real, visible y preparada para crecer.</h1>

                    <p class="lead">
                        Este backend Laravel centraliza contenido público del portfolio, documentación técnica, formularios de contacto
                        y la nueva capa de laboratorios reales. La raíz pública sirve como acceso rápido para revisión técnica,
                        integración y futuras ampliaciones del laboratorio de marca.
                    </p>

                    <div class="hero-actions">
                        <a class="btn primary" href="{{ url('/docs/api') }}">Abrir documentación</a>
                        <a class="btn" href="{{ url('/health') }}">Health check</a>
                        <a class="btn" href="{{ url('/api/portfolio-home') }}">Probar portfolio-home</a>
                    </div>
                </div>

                <div class="hero-panel">
                    <div class="hero-card">
                        <span>Base pública</span>
                        <strong>{{ url('/') }}</strong>
                    </div>
                    <div class="hero-card">
                        <span>Base API</span>
                        <strong>{{ url('/api') }}</strong>
                    </div>
                    <div class="hero-card">
                        <span>Documentación OpenAPI</span>
                        <strong>{{ url('/docs/api') }}</strong>
                    </div>
                    <div class="hero-card">
                        <span>Estado actual</span>
                        <strong>Operativo / en evolución controlada</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="section grid">
            <article class="card span-7">
                <h2>Resumen técnico</h2>
                <p class="muted">
                    La API expone una superficie pública mínima pero profesional para alimentar el frontend del portfolio
                    y mostrar una base real de backend desacoplado. También deja preparada la estructura para ampliar
                    documentación, automatizaciones, casos de uso y servicios conectados sin rehacer la arquitectura.
                </p>

                <div class="stats">
                    <div class="stat">
                        <strong>Frontend consumidor</strong>
                        <span class="muted">Portfolio React/Vite conectado por API</span>
                    </div>
                    <div class="stat">
                        <strong>Documentación</strong>
                        <span class="muted">Scramble + OpenAPI accesible públicamente</span>
                    </div>
                    <div class="stat">
                        <strong>Superficie pública</strong>
                        <span class="muted">Home, health, docs y endpoints reales</span>
                    </div>
                    <div class="stat">
                        <strong>Estrategia</strong>
                        <span class="muted">Crecimiento incremental sin romper contrato</span>
                    </div>
                </div>
            </article>

            <article class="card span-5">
                <h2>Stack y base</h2>
                <ul class="list stack-list">
                    <li>Laravel como API REST con Resources y contratos públicos limpios.</li>
                    <li>Docker para entorno de ejecución y despliegue replicable.</li>
                    <li>Autenticación y endpoints protegidos preparados con Sanctum.</li>
                    <li>Documentación OpenAPI visible para revisión e integración.</li>
                    <li>Base preparada para laboratorios reales, automatización y nuevas capas públicas.</li>
                </ul>
            </article>

            <article class="card span-7">
                <h2>Endpoints destacados</h2>
                <ul class="list">
                    <li class="endpoint">
                        <span class="badge">GET</span>
                        <div class="endpoint-copy">
                            <code>/api/portfolio-home</code>
                            <p>Carga agregada principal del portfolio público.</p>
                        </div>
                    </li>
                    <li class="endpoint">
                        <span class="badge">GET</span>
                        <div class="endpoint-copy">
                            <code>/api/portfolio-home/about</code>
                            <p>Bloque informativo y técnico para la sección about.</p>
                        </div>
                    </li>
                    <li class="endpoint">
                        <span class="badge">GET</span>
                        <div class="endpoint-copy">
                            <code>/api/laboratorios-reales/home</code>
                            <p>Resumen optimizado de laboratorios reales para home o previews.</p>
                        </div>
                    </li>
                    <li class="endpoint">
                        <span class="badge">GET</span>
                        <div class="endpoint-copy">
                            <code>/api/laboratorios-reales</code>
                            <p>Listado general de laboratorios reales en formato resumido.</p>
                        </div>
                    </li>
                    <li class="endpoint">
                        <span class="badge">POST</span>
                        <div class="endpoint-copy">
                            <code>/api/contact-messages</code>
                            <p>Recepción pública de mensajes del formulario de contacto.</p>
                        </div>
                    </li>
                </ul>
            </article>

            <article class="card span-5">
                <h2>Accesos rápidos</h2>
                <div class="quick-links">
                    <a class="quick-link" href="{{ url('/docs/api') }}">
                        <div>
                            <strong>Documentación navegable</strong>
                            <small>Referencia OpenAPI para explorar endpoints y schemas.</small>
                        </div>
                        <span>→</span>
                    </a>

                    <a class="quick-link" href="{{ url('/docs/api.json') }}">
                        <div>
                            <strong>Documento OpenAPI JSON</strong>
                            <small>Salida bruta para inspección técnica o herramientas externas.</small>
                        </div>
                        <span>→</span>
                    </a>

                    <a class="quick-link" href="{{ url('/health') }}">
                        <div>
                            <strong>Estado del servicio</strong>
                            <small>Comprobación básica del backend público.</small>
                        </div>
                        <span>→</span>
                    </a>

                    <a class="quick-link" href="{{ url('/api/portfolio-home') }}">
                        <div>
                            <strong>Respuesta de ejemplo</strong>
                            <small>Entrada principal consumida por el frontend del portfolio.</small>
                        </div>
                        <span>→</span>
                    </a>
                </div>

                <div class="mini-note">
                    Algunas rutas siguen en evolución y la documentación continuará refinándose conforme avance la capa pública del backend.
                </div>
            </article>

            <article class="card span-6">
                <h2>Ahora</h2>
                <ul class="list timeline">
                    <li>Raíz pública accesible para revisión técnica rápida.</li>
                    <li>Health check independiente para verificación básica.</li>
                    <li>Documentación pública disponible en <code>/docs/api</code>.</li>
                    <li>Portfolio home y laboratorios reales ya expuestos como API utilizable.</li>
                </ul>
            </article>

            <article class="card span-6">
                <h2>Siguiente fase</h2>
                <ul class="list timeline">
                    <li>Más profundidad documental en endpoints y recursos clave.</li>
                    <li>Mejor exposición de laboratorios reales y casos de uso.</li>
                    <li>Ampliación hacia una capa pública de laboratorio técnico de marca.</li>
                    <li>Posible incorporación de métricas, ejemplos guiados y estados más ricos.</li>
                </ul>
            </article>
        </section>

        <footer>
            <p>
                Punto público del backend y base estable para consumidores técnicos, documentación e integración incremental del ecosistema del portfolio.
            </p>
        </footer>
    </main>
</body>
</html>
