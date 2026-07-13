<p align="center">
  <img src="https://githubusercontent.com" width="350" alt="Laravel Logo">
</p>

# 🚀 Infrastructure Lab & Portfolio API (Laravel + Docker)

Backend principal y API REST del portfolio profesional, el laboratorio técnico público y el panel administrativo interno. El proyecto está construido con Laravel bajo una arquitectura desacoplada (_headless_), pensado para servir contenido estructurado al frontend, exponer documentación técnica pública y mantener una base extensible para automatización, documentación e integraciones futuras.

🔗 **Frontend:** [https://alex.syskovex.com/](https://alex.syskovex.com/)  
🔗 **Backend API:** [https://portfolio-api.syskovex.com/](https://portfolio-api.syskovex.com/)

---

## 🧱 Stack principal

- **Core backend:** Laravel `13.8`
- **Runtime:** PHP `8.4`
- **Arquitectura:** API REST desacoplada
- **Autenticación:** Laravel Sanctum `4.x`
- **Panel administrativo:** Filament `5.6`
- **OpenAPI / documentación:** `dedoc/scramble` `0.13.32`
- **Mensajería:** Resend `1.4`
- **Base de datos:** PostgreSQL sobre Neon
- **Contenedores:** Docker + Docker Compose
- **Despliegue:** Render
- **Frontend consumidor:** React + Vite

---

## 🌐 Acceso público

### URLs principales

- **Frontend:** [https://alex.syskovex.com/](https://alex.syskovex.com/)
- **Backend público:** [https://portfolio-api.syskovex.com/](https://portfolio-api.syskovex.com/)
- **Base URL API:** `https://portfolio-api.syskovex.com/api`
- **Documentación UI:** [https://portfolio-api.syskovex.com/docs/api](https://portfolio-api.syskovex.com/docs/api)
- **OpenAPI JSON:** [https://portfolio-api.syskovex.com/docs/api.json](https://portfolio-api.syskovex.com/docs/api.json)
- **Panel admin:** [https://portfolio-api.syskovex.com/admin](https://portfolio-api.syskovex.com/admin)

### Superficie pública expuesta

| Ruta | Tipo | Descripción |
| :--- | :--- | :--- |
| `/` | Web pública | Landing técnica del backend. |
| `/health` | JSON técnico | Health check ligero del servicio. |
| `/docs/api` | Documentación UI | Interfaz navegable de la API. |
| `/docs/api.json` | OpenAPI 3.1 | Esquema bruto para integración técnica. |
| `/admin` | Panel privado | Acceso al panel administrativo Filament. |

### Notas de implementación

- La documentación pública se sirve con **Scramble**.
- El acceso a la documentación se controla mediante la gate `viewApiDocs`.
- Se mantiene `JsonResource::withoutWrapping()` para respuestas JSON planas.
- En producción se fuerza `https` con `URL::forceScheme('https')`.

---

## 🧩 Dominio funcional

El backend está orientado a portfolio, laboratorio técnico, contacto y administración interna.

### Modelos principales

- `AdjuntoLaboratorio`
- `AvanceLaboratorio`
- `ContactMessage`
- `DocumentacionLaboratorio`
- `IdeaLaboratorio`
- `LaboratorioReal`
- `ProfileExpertise`
- `ProfileHighlight`
- `Project`
- `ProyectoAdjunto`
- `ProyectoDocumentacion`
- `ProyectoSeccion`
- `Skill`
- `SocialLink`
- `User`

### Recursos API (`JsonResource`)

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

### Áreas funcionales

- **Portfolio:** contenido principal del perfil, enlaces sociales, proyectos y bloque “about”.
- **Projects:** catálogo público de proyectos y CRUD protegido.
- **Laboratorios reales:** contenido documental y técnico con avances, adjuntos, ideas y documentación asociada.
- **Contact messages:** recepción de mensajes y disparo de notificaciones.
- **Panel admin:** gestión centralizada del contenido desde Filament.

---

## 📌 Endpoints principales

Base pública de la API:

```text
https://portfolio-api.syskovex.com/api
```

### 🔒 Autenticación

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | Pública | Autentica un usuario administrador. |
| `POST` | `/api/logout` | `auth:sanctum` | Revoca la sesión autenticada actual. |
| `GET` | `/api/verify-auth` | `auth:sanctum` | Verifica el token y devuelve el usuario autenticado. |

### 🧑‍💻 Portfolio público

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/portfolio-home` | Pública | Devuelve la carga agregada principal del portfolio. |
| `GET` | `/api/portfolio-home/about` | Pública | Devuelve el bloque “about” y contenido complementario. |
| `GET` | `/api/projects` | Pública | Lista los proyectos publicados. |
| `GET` | `/api/projects/{id}` | Pública | Devuelve el detalle técnico de un proyecto. |

### 🔬 Laboratorios reales

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/laboratorios-reales/home` | Pública | Resume el contenido del laboratorio real. |
| `GET` | `/api/laboratorios-reales` | Pública | Lista laboratorios publicados. |
| `GET` | `/api/laboratorios-reales/{slug}` | Pública | Devuelve el detalle por slug. |

### ✉️ Contacto

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/contact-messages` | Pública | Registra un mensaje y ejecuta la lógica de notificación configurada. |

### 📝 CRUD protegido de proyectos

| Método | Endpoint | Protección | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/projects` | `auth:sanctum` | Crea un nuevo proyecto. |
| `PUT` | `/api/projects/{id}` | `auth:sanctum` | Actualiza un proyecto existente. |
| `DELETE` | `/api/projects/{id}` | `auth:sanctum` | Elimina un proyecto. |

---

## 🧪 Pruebas rápidas

### Health check

```bash
curl -X GET http://localhost:8081/health \
  -H "Accept: application/json"
```

### Portfolio home

```bash
curl -X GET http://localhost:8081/api/portfolio-home \
  -H "Accept: application/json"
```

### About del portfolio

```bash
curl -X GET http://localhost:8081/api/portfolio-home/about \
  -H "Accept: application/json"
```

### Listado de proyectos

```bash
curl -X GET http://localhost:8081/api/projects \
  -H "Accept: application/json"
```

### Home de laboratorios reales

```bash
curl -X GET http://localhost:8081/api/laboratorios-reales/home \
  -H "Accept: application/json"
```

### Login admin

```bash
curl -X POST http://localhost:8081/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"tu_usuario@dominio.com\", \"password\":\"tu_password_local\"}"
```

### Verificación de sesión

```bash
curl -X GET http://localhost:8081/api/verify-auth \
  -H "Accept: application/json" \
  -H "Authorization: Bearer INSERTA_TU_TOKEN_AQUI"
```

---

## 🐋 Flujo local con Docker

El backend se ejecuta en un contenedor llamado `portfolio_backend` con mapeo `8081:80`.

### Levantar entorno

```bash
docker compose up -d --build
```

### Ver contenedores activos

```bash
docker ps
```

### Listar rutas

```bash
docker exec -it portfolio_backend php artisan route:list
```

### Ejecutar migraciones

```bash
docker exec -it portfolio_backend php artisan migrate
```

### Limpiar caché

```bash
docker exec -it portfolio_backend php artisan optimize:clear
```

### Regenerar OpenAPI

```bash
docker exec -it portfolio_backend php artisan scramble:export
```

---

## ⚙️ Entorno e infraestructura

### Variables de entorno clave

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

### Notas operativas

- `QUEUE_CONNECTION=sync` permite procesamiento inmediato sin workers dedicados.
- `DB_SSLMODE=require` fuerza conexión segura con Neon.
- `MAIL_MAILER=resend` evita depender de SMTP saliente tradicional.
- `LOG_CHANNEL=stderr` es apropiado para ejecución en contenedores.
- `APP_DEBUG=false` y `URL::forceScheme('https')` refuerzan el entorno productivo.

### Disponibilidad en Render

- En Render, los servicios gratuitos pueden entrar en reposo tras periodos de inactividad y generar **cold starts**. [web:233]
- Para reducir ese efecto, se utiliza un monitor HTTP externo que hace ping periódico al endpoint `/health`. [web:233]
- Este mecanismo mejora la disponibilidad percibida, aunque la forma oficialmente soportada de evitar el spin-down continuo sigue siendo usar un plan no gratuito. [web:233]

---

## 🔒 CORS

La política definida en `config/cors.php` limita orígenes y cabeceras permitidas.

- **Paths protegidos:** `api/*` y `sanctum/csrf-cookie`
- **Métodos permitidos:** `GET`, `POST`, `PUT`, `DELETE`, `OPTIONS`
- **Orígenes permitidos:** `https://alex.syskovex.com` y `http://localhost:5173`
- **Cabeceras permitidas:** `Content-Type`, `X-Requested-With`, `Authorization`, `Accept`
- **Cache preflight (`max_age`):** `86400`
- **Credenciales:** `supports_credentials=true`

---

## 📚 OpenAPI con Scramble

La documentación se genera con **dedoc/scramble** a partir de rutas, requests, resources y responses.

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
- **Servidores documentados:**
  - `Production`: `APP_URL/api`
  - `Local`: `http://localhost:8081/api`

---

## 🧩 Panel administrativo

El panel de administración se sirve en `/admin` mediante Filament.

### Organización actual

- La navegación del panel está agrupada por dominio funcional, principalmente **Laboratorios** y **Proyectos**. [web:233]
- Los recursos hijos de proyectos se gestionan desde relation managers dentro del recurso `Projects`, en lugar de exponerse como entradas separadas en el sidebar. [web:481][web:459]
- Esto mantiene una navegación más limpia y un flujo de edición más consistente dentro del panel. [web:481]

### Recursos principales detectados

- `ContactMessages`
- `LaboratorioReals`
- `ProfileExpertises`
- `ProfileHighlights`
- `Projects`
- `Skills`
- `SocialLinks`

### Propósito

- Gestionar contenido del portfolio.
- Administrar habilidades y enlaces sociales.
- Mantener laboratorios reales.
- Revisar mensajes de contacto.
- Centralizar operaciones CRUD sin exponerlas públicamente.

---

## 🤖 Asistente experimental

Instancia pública del asistente conectada al ecosistema del laboratorio:

- [Asistente n8n / Hugging Face](https://alexandergalvez-asistenten8n.hf.space/home/workflows)

---

## 📁 Estructura resumida

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

## ✅ Estado actual

El backend ya expone una base pública funcional, health check, documentación OpenAPI navegable, autenticación con Sanctum, administración con Filament, catálogo público de proyectos, bloque documental de laboratorios y una base técnica lista para seguir creciendo.