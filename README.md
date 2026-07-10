<p align="center">
  <img src="https://githubusercontent.com" width="350" alt="Laravel Logo">
</p>

# 🚀 Infrastructure Lab & Portfolio API (Laravel & Docker Native)

Este repositorio contiene el backend y la API REST que alimentan mi portafolio profesional, el bloque público de laboratorio y el panel administrativo del proyecto. Está construido con Laravel bajo una arquitectura desacoplada (_headless_), expone contenido estructurado para el frontend y deja preparada una base evolutiva para automatización, documentación técnica e integraciones futuras.

🔗 **Frontend:** [https://alex.syskovex.com/](https://alex.syskovex.com/)  
🔗 **Backend API:** [https://portfolio-api.syskovex.com/](https://portfolio-api.syskovex.com/)

---

## 🛠️ Arquitectura y stack tecnológico

La base técnica actualmente confirmada en el proyecto es la siguiente:

- **Core backend:** Laravel `13.8`
- **Runtime:** PHP `8.4`
- **Arquitectura de acceso:** API REST desacoplada
- **Autenticación:** Laravel Sanctum `4.x`
- **Panel administrativo:** Filament `5.6`
- **Documentación OpenAPI:** `dedoc/scramble` `0.13.32`
- **Mensajería:** Resend `1.4`
- **Base de datos:** PostgreSQL sobre Neon
- **Contenerización:** Docker y Docker Compose
- **Despliegue:** Render
- **Frontend consumidor:** React + Vite

---

## 🌐 Acceso público y documentación API

Este backend Laravel expone una superficie pública mínima y profesional para facilitar revisión técnica, integración y evolución futura del proyecto.

### URLs públicas

- **Frontend:** [https://alex.syskovex.com/](https://alex.syskovex.com/)
- **Backend público:** [https://portfolio-api.syskovex.com/](https://portfolio-api.syskovex.com/)
- **Base URL API:** `https://portfolio-api.syskovex.com/api`
- **Documentación UI:** [https://portfolio-api.syskovex.com/docs/api](https://portfolio-api.syskovex.com/docs/api)
- **OpenAPI JSON:** [https://portfolio-api.syskovex.com/docs/api.json](https://portfolio-api.syskovex.com/docs/api.json)
- **Panel admin:** [https://portfolio-api.syskovex.com/admin](https://portfolio-api.syskovex.com/admin)

### Rutas públicas principales

| Ruta | Tipo | Descripción |
| :--- | :--- | :--- |
| `/` | Web pública | Landing técnica del backend y punto de acceso visual. |
| `/health` | JSON técnico | Health check ligero del servicio. |
| `/docs/api` | Documentación UI | Referencia navegable de la API generada automáticamente. |
| `/docs/api.json` | OpenAPI 3.1 | Esquema bruto para inspección técnica e integración. |
| `/admin` | Panel privado | Acceso al panel administrativo en Filament. |

### Notas de implementación

- La documentación pública se sirve con **Scramble**.
- Se habilitó acceso a la documentación mediante la gate `viewApiDocs`.
- Se mantiene `JsonResource::withoutWrapping()` para respuestas JSON planas.
- En producción se fuerza `https` con `URL::forceScheme('https')`.

---

## 📋 Variables de entorno clave (`Environment`)

Estas variables se configuran fuera del repositorio y forman parte de la base operativa del despliegue:

```env
APP_NAME="Portfolio Backend API"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://portfolio-api.syskovex.com
API_VERSION=1.0.0

DB_CONNECTION=pgsql
DB_HOST=ep-your-neon-domain.pooler.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=user
DB_PASSWORD=**
DB_SSLMODE=require

QUEUE_CONNECTION=sync

MAIL_MAILER=resend
RESEND_API_KEY=re_xxxxxxxxxxxxx
MAIL_FROM_ADDRESS=alex@syskovex.com
MAIL_FROM_NAME="Alexander Galvez"

LOG_CHANNEL=stderr
```

### Notas de infraestructura asociadas

- `QUEUE_CONNECTION=sync` permite procesamiento inmediato si no se usan workers separados.
- `DB_SSLMODE=require` asegura conexión SSL con Neon.
- `MAIL_MAILER=resend` evita depender de SMTP saliente en entornos cloud limitados.
- `LOG_CHANNEL=stderr` es adecuado para contenedores en producción.

---

## 💾 Arquitectura funcional y modelos técnicos

Actualmente el proyecto expone una base de datos orientada a portfolio, contacto, laboratorio real y administración interna.

### Modelos detectados en el proyecto

- `AdjuntoLaboratorio`
- `AvanceLaboratorio`
- `ContactMessage`
- `DocumentacionLaboratorio`
- `IdeaLaboratorio`
- `LaboratorioReal`
- `ProfileExpertise`
- `ProfileHighlight`
- `Project`
- `Skill`
- `SocialLink`
- `User`

### Recursos API (`JsonResource`)

La serialización pública de datos utiliza recursos de Laravel para mantener consistencia estructural en las respuestas:

- `AboutResource`
- `AdjuntoLaboratorioResource`
- `AvanceLaboratorioResource`
- `DocumentacionLaboratorioResource`
- `IdeaLaboratorioResource`
- `LaboratorioRealHomeResource`
- `LaboratorioRealResource`
- `PortfolioHomeResource`
- `ProjectCardResource`
- `ProjectResource`
- `SkillResource`
- `SocialLinkResource`
- `UserResource`

### Estructura funcional del dominio

- **Portfolio:** contenido principal del perfil, enlaces sociales, proyectos y bloques “about”.
- **Projects:** catálogo público de proyectos y operaciones CRUD protegidas.
- **Laboratorios reales:** bloques documentales y técnicos para exponer entornos, avances, adjuntos, ideas y documentación asociada.
- **Contact messages:** entrada de mensajes de contacto con persistencia y notificación.
- **Panel admin:** gestión de contenido mediante Filament.

---

## 📌 Endpoints documentados del proyecto

La URL base pública de la API es:

```text
https://portfolio-api.syskovex.com/api
```

### 🔒 Autenticación y control de sesión

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | Pública | Autentica un usuario administrador. |
| `POST` | `/api/logout` | `auth:sanctum` | Revoca la sesión autenticada actual. |
| `GET` | `/api/verify-auth` | `auth:sanctum` | Verifica el token y devuelve el usuario autenticado. |

### 🧑‍💻 Portfolio y contenido público

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/portfolio-home` | Pública | Devuelve la carga principal del portfolio: enlaces sociales, proyectos destacados y contenido agregado. |
| `GET` | `/api/portfolio-home/about` | Pública | Devuelve el bloque “about” con skills y contenido complementario del perfil. |
| `GET` | `/api/projects` | Pública | Lista los proyectos públicos. |
| `GET` | `/api/projects/{id}` | Pública | Devuelve el detalle técnico de un proyecto. |

### 🔬 Laboratorios reales

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/laboratorios-reales/home` | Pública | Devuelve un resumen estructurado del laboratorio real. |
| `GET` | `/api/laboratorios-reales` | Pública | Lista los laboratorios reales publicados. |
| `GET` | `/api/laboratorios-reales/{slug}` | Pública | Devuelve el detalle de un laboratorio real por slug. |

### ✉️ Entrada de datos y contacto

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/contact-messages` | Pública | Registra un mensaje de contacto y ejecuta la lógica de notificación configurada. |

### 📝 Operaciones CRUD protegidas

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/projects` | `auth:sanctum` | Crea un nuevo proyecto. |
| `PUT` | `/api/projects/{id}` | `auth:sanctum` | Actualiza un proyecto existente. |
| `DELETE` | `/api/projects/{id}` | `auth:sanctum` | Elimina un proyecto. |

---

## 🧪 Ejemplos de pruebas e integración local

Puedes verificar el estado operativo de los endpoints con `curl` desde Git Bash.

### 1. Health check del backend

```bash
curl -X GET http://localhost:8081/health \
  -H "Accept: application/json"
```

### 2. Carga principal del portfolio

```bash
curl -X GET http://localhost:8081/api/portfolio-home \
  -H "Accept: application/json"
```

### 3. Bloque about del portfolio

```bash
curl -X GET http://localhost:8081/api/portfolio-home/about \
  -H "Accept: application/json"
```

### 4. Catálogo público de proyectos

```bash
curl -X GET http://localhost:8081/api/projects \
  -H "Accept: application/json"
```

### 5. Home de laboratorios reales

```bash
curl -X GET http://localhost:8081/api/laboratorios-reales/home \
  -H "Accept: application/json"
```

### 6. Listado de laboratorios reales

```bash
curl -X GET http://localhost:8081/api/laboratorios-reales \
  -H "Accept: application/json"
```

### 7. Autenticación de administrador y captura de token

```bash
curl -X POST http://localhost:8081/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"tu_usuario@dominio.com\", \"password\":\"tu_password_local\"}"
```

### 8. Verificación de sesión con Sanctum

```bash
curl -X GET http://localhost:8081/api/verify-auth \
  -H "Accept: application/json" \
  -H "Authorization: Bearer INSERTA_TU_TOKEN_AQUI"
```

---

## 🐋 Comandos de control en desarrollo local (Docker + Git Bash)

El backend se ejecuta localmente en un contenedor llamado `portfolio_backend` con publicación de puerto `8081:80`.

### Iniciar el contenedor local

```bash
docker compose up -d --build
```

### Ver contenedores activos

```bash
docker ps
```

### Listar rutas registradas

```bash
docker exec -it portfolio_backend php artisan route:list
```

### Instalar dependencias en caliente

```bash
docker exec -it portfolio_backend composer require vendor/package
```

### Limpiar caché tras modificar `.env`

```bash
docker exec -it portfolio_backend php artisan config:clear
docker exec -it portfolio_backend php artisan cache:clear
docker exec -it portfolio_backend php artisan route:clear
docker exec -it portfolio_backend php artisan view:clear
```

### Ejecutar migraciones

```bash
docker exec -it portfolio_backend php artisan migrate
```

### Regenerar documentación OpenAPI

```bash
docker exec -it portfolio_backend php artisan scramble:export
```

---

## 🔒 Seguridad CORS (Cross-Origin Resource Sharing)

El backend implementa una política de acceso concreta definida en `config/cors.php` para limitar orígenes y cabeceras admitidas.

- **Paths protegidos:** `api/*` y `sanctum/csrf-cookie`
- **Métodos permitidos:** `GET`, `POST`, `PUT`, `DELETE`, `OPTIONS`
- **Orígenes permitidos:** `https://alex.syskovex.com` y `http://localhost:5173`
- **Cabeceras permitidas:** `Content-Type`, `X-Requested-With`, `Authorization`, `Accept`
- **Cache preflight (`max_age`):** `86400`
- **Credenciales:** `supports_credentials=true`

---

## 📚 Documentación automática con Scramble

La documentación se genera con **dedoc/scramble**, lo que permite exponer OpenAPI automáticamente a partir de rutas, requests, resources y responses del backend Laravel.

### Instalación base

```bash
composer require dedoc/scramble
php artisan vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider" --tag="scramble-config"
```

### Configuración destacada

- **Título UI:** `Portfolio Backend API`
- **Renderer activo:** `elements`
- **Tema:** `light`
- **Try it:** habilitado
- **Schemas:** visibles
- **Servidores definidos en docs:**
  - `Production`: `APP_URL/api`
  - `Local`: `http://localhost:8081/api`

---

## 🧩 Panel administrativo con Filament

El proyecto incluye un panel de administración en `/admin` para la gestión interna de contenido.

### Recursos detectados en Filament

- `ContactMessages`
- `LaboratorioReals`
- `ProfileExpertises`
- `ProfileHighlights`
- `Projects`
- `Skills`
- `SocialLinks`

### Propósito del panel

- Gestionar contenido del portfolio
- Administrar habilidades y enlaces sociales
- Mantener laboratorios reales
- Revisar mensajes de contacto
- Centralizar operaciones CRUD sin exponerlas públicamente

---

## ⚙️ Consideraciones de infraestructura y automatización

1. **Resend sobre HTTP/443** evita depender de SMTP saliente en entornos cloud con restricciones.
2. **Render Free** puede provocar _cold starts_ después de periodos de inactividad.
3. **QUEUE_CONNECTION=sync** simplifica el procesamiento inmediato cuando no se usan workers separados.
4. **Neon PostgreSQL** se usa con `sslmode=require`.
5. **PDO::ATTR_PERSISTENT=false** está configurado en `pgsql` para evitar conexiones persistentes innecesarias.
6. **APP_DEBUG=false** y `LOG_CHANNEL=stderr` son ajustes adecuados para producción.
7. **view:cache** puede ser una optimización útil en despliegues productivos.
8. **URL::forceScheme('https')** evita inconsistencias de esquema en producción.

---

## 🤖 Asistente real

Instancia pública del asistente experimental conectado al ecosistema del laboratorio:

- [Asistente n8n / Hugging Face](https://alexandergalvez-asistenten8n.hf.space/home/workflows)

---

## 📁 Estructura funcional resumida

```text
app/
  Filament/
  Http/
    Controllers/
    Requests/
    Resources/
  Models/

config/
  app.php
  cors.php
  database.php
  mail.php
  queue.php
  sanctum.php
  scramble.php

resources/views/
  backend-home.blade.php
  emails/
  welcome.blade.php

routes/
  api.php
  web.php
  console.php

Dockerfile
docker-compose.yml
README.md
```

---

## ✅ Estado actual del backend

Este backend ya expone una base pública funcional, health check, documentación OpenAPI navegable, autenticación con Sanctum, administración con Filament y una estructura real para evolucionar el portfolio hacia un laboratorio técnico más amplio y mejor documentado.