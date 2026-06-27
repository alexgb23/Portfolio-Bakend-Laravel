<p align="center">
  <img src="https://githubusercontent.com" width="350" alt="Laravel Logo">
</p>

# 🚀 Infrastructure Lab & Portfolio API (Laravel & Docker Native)

Este repositorio contiene el núcleo del backend y la API REST que gestiona mi portafolio profesional y el panel de telemetría de mi **Laboratorio de Infraestructura, Automatización y Computación Edge**. Diseñado bajo una arquitectura desacoplada (*Headless*), expone datos estructurados en tiempo real sobre clusters hibridados, métricas de servidores físicos, domótica integrada e Inteligencia Artificial local.

🔗 **Frontend (Netlify):** [https://netlify.app](https://netlify.app)  
🔗 **Backend API (Render):** [https://onrender.com](https://onrender.com)

---

## 🛠️ Arquitectura y Stack Tecnológico

La infraestructura está automatizada de extremo a extremo, optimizada para funcionar de forma autónoma en la nube sin intervención directa en la consola:

*   **Core:** Laravel (PHP 8.4) configurado estrictamente en modo API REST de alta disponibilidad.
*   **Contenedores:** **Docker & Docker Compose** para asegurar un entorno local idéntico al de producción.
*   **Servidor Web (Producción):** **Render** (Plan Free) configurado mediante *Docker Deployment* nativo con despliegue continuo.
*   **Base de Datos Relacional:** **Neon DB** (Serverless PostgreSQL) con soporte nativo `pdo_pgsql` y conexiones SSL seguras.
*   **Mensajería y Alertas:** **Resend API** integrado sobre protocolo HTTP (Puerto 443). Esto evita los bloqueos drásticos de puertos SMTP tradicionales (25, 465, 587) aplicados en servidores en la nube gratuitos.
*   **Gestor Administrativo:** Filament PHP para la administración inmutable de métricas, clústeres y configuraciones de IA.

---

## 📋 Variables de Entorno Clave (`Environment`)

Configuradas directamente en el panel web de Render (Protegidas y fuera del repositorio):

```env
DB_CONNECTION=pgsql
DB_HOST=ep-your-neon-domain.pooler.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=alexandergalvez880208
DB_PASSWORD=tu_contraseña_secreta_de_neon
DB_SSLMODE=require

# Forzar procesamiento inmediato por ausencia de Background Workers independientes en el plan gratis
QUEUE_CONNECTION=sync

# Proveedor de Correo HTTP Seguro (Puerto 443)
MAIL_MAILER=resend
RESEND_API_KEY=re_tu_llave_secreta_de_resend
MAIL_FROM_ADDRESS=onboarding@resend.dev
MAIL_FROM_NAME="Portfolio Alex"
```

---

## 💾 Arquitectura de la Base de Datos (Modelos Técnicos)

El esquema de base de datos relacional modela el hardware y software del laboratorio mediante las siguientes entidades clave y relaciones complejas:

*   **`Cluster` ↔ `Server` (N:M a través de `ClusterServer`):** Relación de muchos a muchos que modela la topología de red del laboratorio. La tabla intermedia pivote almacena datos de infraestructura críticos como el rol del nodo (`node_role`) y la precedencia física (`sort_order`).
*   **`HomeAssistantInstance` → `HomeAssistantUseCase` (1:N):** Abstracción de entornos IoT. Cada instancia centraliza múltiples casos de uso de automatización residencial y control lógico Edge filtrados dinámicamente por visibilidad y criticidad.
*   **`AiStudyCase` & `LabCapability`:** Entidades inmutables destinadas a documentar arquitecturas de LLMs corporativos ejecutados de forma local, benchmarks de inferencia, notas técnicas y niveles de madurez operacional (`capability_level`).
*   **`ContactMessage`:** Gestor transaccional de mensajería asíncrona optimizado con filtros condicionales nativos para lectura de registros (`scopeUnread`, `scopeRead`).

---

## 📌 Documentación de Endpoints (API Reference)

La URL base de producción es: `https://onrender.com`

### 🔒 Autenticación y Control de Sesión

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/login` | `api` | Autentica administradores y retorna el token Sanctum. |
| `POST` | `/logout` | `api`, `auth:sanctum` | Revoca el token de la sesión actual. |
| `GET` | `/verify-auth` | `api`, `auth:sanctum` | Valida el estado del token y retorna el perfil de usuario. |

### 📊 Telemetría de Servidores, Redes y Clústeres

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/clusters` | `api` | Lista los clústeres de computación activos. |
| `GET` | `/clusters/{id}` | `api` | Obtiene la topología detallada y servidores mapeados con su rol. |
| `GET` | `/servers` | `api` | Retorna los servidores físicos o virtuales del laboratorio. |
| `GET` | `/servers/{id}` | `api` | Detalle de hardware y estado de un servidor. |
| `GET` | `/nodes` | `api` | Lista los nodos de computación distribuidos. |
| `GET` | `/nodes/{id}` | `api` | Estado, configuración y asignación de un nodo. |
| `GET` | `/metrics` | `api` | Métricas de rendimiento agregadas del laboratorio. |
| `GET` | `/metrics/{id}` | `api` | Histórico de carga, CPU, RAM y almacenamiento de un recurso. |

### 🤖 Inteligencia Artificial & Automatización (Edge)

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/home-assistant` | `api` | Lista las instancias de domótica e integraciones IoT activas. |
| `GET` | `/home-assistant/{id}` | `api` | Casos de uso avanzados y automatizaciones de la instancia. |
| `GET` | `/local-ai-setups` | `api` | Configuraciones de LLMs y modelos ejecutados de forma local. |
| `GET` | `/local-ai-setups/{id}` | `api` | Parámetros técnicos del hardware/modelo de IA local. |
| `GET` | `/ai-study-cases` | `api` | Casos de estudio y benchmarks de IA aplicada. |
| `GET` | `/ai-study-cases/{id}` | `api` | Contexto, desafíos y soluciones de arquitecturas de IA. |

### 🔬 Laboratorio, Proyectos y Portafolio

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/portfolio-home` | `api` | Bloque principal de datos (enlaces sociales, habilidades, destacados). |
| `GET` | `/laboratorio/home`| `api` | Datos estructurados de presentación del Laboratorio técnico. |
| `GET` | `/laboratorio` | `api` | Módulos e ítems de experimentación activos. |
| `GET` | `/laboratorio/{id}`| `api` | Detalle específico de un entorno o bloque del laboratorio. |
| `GET` | `/projects` | `api` | Catálogo de proyectos públicos desarrollados. |
| `GET` | `/projects/{id}` | `api` | Ficha técnica y documentación de un proyecto. |
| `GET` | `/lab-capabilities`| `api` | Lista las capacidades operacionales y de testing del laboratorio. |
| `GET` | `/research-sources`| `api` | Fuentes de datos, papers y documentación de soporte de I+D. |

### ✉️ Entrada de Datos (Contacto)

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/contact-messages`| `api` | Registra el mensaje en Postgres (Neon) y envía una notificación instantánea vía Resend. |

### 📝 Operaciones CRUD de Administración (Protegidas)

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/projects` | `api`, `auth:sanctum` | Registra un nuevo proyecto en el portafolio. |
| `PUT` | `/projects/{id}` | `api`, `auth:sanctum` | Actualiza la información técnica de un proyecto existente. |
| `DELETE`| `/projects/{id}` | `api`, `auth:sanctum` | Remueve un proyecto del catálogo de forma permanente. |

---

## 🐋 Comandos de Control en Desarrollo Local (Docker Windows/Git Bash)

Dado que las carpetas compartidas están enlazadas a tu volumen local, usa estos comandos directamente para controlar el contenedor local llamado `portfolio_backend`:

### Iniciar el contenedor local (Recompilando cambios)
```bash
docker compose up -d --build
```

### Instalar dependencias en caliente
```bash
docker exec -it portfolio_backend composer require resend/resend-laravel
```

### Limpieza de caché (Ejecutar tras modificar el `.env` local)
```bash
docker exec -it portfolio_backend php artisan config:clear
docker exec -it portfolio_backend php artisan cache:clear
```

### Ejecutar migraciones hacia la base de datos de desarrollo/producción
```bash
docker exec -it portfolio_backend php artisan migrate
```

---

## 🔒 Seguridad CORS (Cross-Origin Resource Sharing)

El backend implementa una política estricta de control de acceso en `config/cors.php` para mitigar ataques de inyección y uso no autorizado de la API. 

*   **Orígenes Permitidos:** Únicamente tu entorno local (`http://localhost:5173`) y tu dominio de producción (`https://netlify.app`).
*   **Cabeceras Explícitas:** Se restringen los comodines (`*`) habilitando solo cabeceras transaccionales esenciales (`Content-Type`, `Authorization`, `Accept`).
*   **Optimización de Red (`max_age`):** Configurado a 24 horas (`86400` segundos) para almacenar en caché las peticiones de verificación previa (*Preflight OPTIONS*). Esto reduce la latencia en Netlify eliminando peticiones redundantes.
*   **Soporte de Credenciales:** Habilitado nativamente (`supports_credentials: true`) para garantizar la correcta transmisión de cabeceras de autenticación con tokens portadores.

---

## 🧪 Pruebas de Integración y Seguridad (Rutas & Sanctum)

Puedes verificar el estado operativo de los endpoints y las restricciones de seguridad utilizando herramientas de consola (`curl`) directamente desde la terminal de Git Bash (ajustando los JSON con comillas escapadas para Windows):

### 1. Comprobación del Catálogo de Proyectos (Ruta Pública)
```bash
curl -X GET http://localhost:8081/api/projects \
     -H "Accept: application/json"
```

### 2. Autenticación de Administrador y Captura de Token (Ruta Pública)
```bash
curl -X POST http://localhost:8081/api/login \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d "{\"email\":\"alexandergalvez880208@gmail.com\", \"password\":\"tu_password_local\"}"
```

### 3. Validación de Sesión Protegida por Token (Filtro Sanctum)
*Si no envías la cabecera con el token devuelto en el paso anterior, el servidor responderá automáticamente un código `401 Unauthorized`.*
```bash
curl -X GET http://localhost:8081/api/verify-auth \
     -H "Accept: application/json" \
     -H "Authorization: Bearer INSERTA_TU_TOKEN_AQUÍ"
```


## ⚙️ Consideraciones de Infraestructura y Automatización Inmutable

1.  **Bloqueo de Puertos SMTP:** Render no permite tráfico SMTP saliente en capas gratuitas. La integración de la API de Resend por el puerto 443 (HTTP estándar) soluciona este problema de manera nativa sin sobrecargar el flujo de datos.
2.  **Límite de Tiempo de Respuesta (Timeout):** Netlify aborta las peticiones tras **26 segundos**. Configurar el driver en `QUEUE_CONNECTION=sync` junto con Resend HTTP permite despachar el correo electrónico en milisegundos, respondiendo al Front inmediatamente.
3.  **Compilación en Frío:** El archivo `Dockerfile` ejecuta limpiezas automáticas de caché en su construcción (`php artisan config:clear`) ignorando errores de base de datos a través de sentencias de escape (`|| true`). Esto garantiza construcciones estables en Render sin comprometer las credenciales dinámicas de Neon DB.

