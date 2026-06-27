<p align="center">
  <img src="https://githubusercontent.com" width="350" alt="Laravel Logo">
</p>

# 🚀 Infrastructure Lab & Portfolio API (Laravel & Docker Native)

Este repositorio contiene el núcleo del backend y la API REST que gestiona mi portafolio profesional y el panel de telemetría de mi **Laboratorio de Infraestructura, Automatización y Computación Edge**. Diseñado bajo una arquitectura desacoplada (_Headless_), expone datos estructurados en tiempo real sobre clústeres híbridos, métricas de servidores físicos, domótica integrada e inteligencia artificial local.

🔗 **Frontend (Netlify):** [https://portfolioalexsys.netlify.app/](https://portfolioalexsys.netlify.app/)  
🔗 **Backend API (Render):** [https://portfolio-backend-d4iy.onrender.com/](https://portfolio-backend-d4iy.onrender.com/)

---

## 🛠️ Arquitectura y Stack Tecnológico

La infraestructura está automatizada de extremo a extremo y optimizada para funcionar de forma autónoma en la nube, sin intervención directa sobre consola:

- **Core:** Laravel (PHP 8.4) configurado en modo API REST.
- **Contenedores:** **Docker** y **Docker Compose** para garantizar un entorno local consistente con producción.
- **Servidor web en producción:** **Render** (Plan Free) configurado mediante _Docker Deployment_ con despliegue continuo.
- **Base de datos relacional:** **Neon DB** (Serverless PostgreSQL) con soporte nativo para `pdo_pgsql` y conexiones SSL seguras.
- **Mensajería y alertas:** **Resend API** integrado sobre HTTP (puerto 443), evitando las limitaciones habituales de SMTP saliente en plataformas cloud gratuitas.
- **Gestor administrativo:** **Filament PHP** para la administración de métricas, clústeres, configuraciones de IA y contenidos del portafolio.

---

## 📋 Variables de Entorno Clave (`Environment`)

Estas variables se configuran directamente desde el panel de Render y permanecen fuera del repositorio:

```env
DB_CONNECTION=pgsql
DB_HOST=ep-your-neon-domain.pooler.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=alexandergalvez880208
DB_PASSWORD=tu_contraseña_secreta_de_neon
DB_SSLMODE=require

# Forzar procesamiento inmediato por ausencia de background workers independientes en el plan gratis
QUEUE_CONNECTION=sync

# Proveedor de correo HTTP seguro (puerto 443)
MAIL_MAILER=resend
RESEND_API_KEY=re_tu_llave_secreta_de_resend
MAIL_FROM_ADDRESS=onboarding@resend.dev
MAIL_FROM_NAME="Portfolio Alex"
```

---

## 💾 Arquitectura de la Base de Datos (Modelos Técnicos)

El esquema relacional modela el hardware y software del laboratorio mediante las siguientes entidades y relaciones clave:

- **`Cluster` ↔ `Server` (N:M a través de `ClusterServer`):** relación muchos a muchos que modela la topología de red del laboratorio. La tabla pivote almacena datos críticos como el rol del nodo (`node_role`) y el orden físico (`sort_order`).
- **`HomeAssistantInstance` → `HomeAssistantUseCase` (1:N):** abstracción de entornos IoT. Cada instancia centraliza múltiples casos de uso de automatización residencial y lógica Edge.
- **`AiStudyCase` y `LabCapability`:** entidades orientadas a documentar arquitecturas de LLMs locales, benchmarks de inferencia, notas técnicas y niveles de madurez operacional (`capability_level`).
- **`ContactMessage`:** gestor transaccional de mensajería asíncrona con filtros nativos como `scopeUnread` y `scopeRead`.

---

## 📌 Documentación de Endpoints (API Reference)

La URL base de producción es:

```text
https://portfolio-backend-d4iy.onrender.com/api
```

### 🔒 Autenticación y Control de Sesión

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/login` | `api` | Autentica administradores y devuelve un token Sanctum. |
| `POST` | `/logout` | `api`, `auth:sanctum` | Revoca el token de la sesión actual. |
| `GET` | `/verify-auth` | `api`, `auth:sanctum` | Valida el estado del token y devuelve el perfil autenticado. |

### 📊 Telemetría de Servidores, Redes y Clústeres

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/clusters` | `api` | Lista los clústeres de computación activos. |
| `GET` | `/clusters/{id}` | `api` | Obtiene la topología detallada y los servidores asociados con su rol. |
| `GET` | `/servers` | `api` | Devuelve los servidores físicos o virtuales del laboratorio. |
| `GET` | `/servers/{id}` | `api` | Muestra el detalle de hardware y estado de un servidor. |
| `GET` | `/nodes` | `api` | Lista los nodos de computación distribuidos. |
| `GET` | `/nodes/{id}` | `api` | Devuelve estado, configuración y asignación de un nodo. |
| `GET` | `/metrics` | `api` | Lista métricas agregadas de rendimiento del laboratorio. |
| `GET` | `/metrics/{id}` | `api` | Devuelve histórico de carga, CPU, RAM y almacenamiento de un recurso. |

### 🤖 Inteligencia Artificial y Automatización Edge

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/home-assistant` | `api` | Lista las instancias de domótica e integraciones IoT activas. |
| `GET` | `/home-assistant/{id}` | `api` | Devuelve automatizaciones y casos de uso avanzados de una instancia. |
| `GET` | `/local-ai-setups` | `api` | Lista configuraciones de LLMs y modelos ejecutados de forma local. |
| `GET` | `/local-ai-setups/{id}` | `api` | Devuelve parámetros técnicos del hardware y modelo local. |
| `GET` | `/ai-study-cases` | `api` | Lista casos de estudio y benchmarks de IA aplicada. |
| `GET` | `/ai-study-cases/{id}` | `api` | Devuelve contexto, retos y soluciones de una arquitectura de IA. |

### 🔬 Laboratorio, Proyectos y Portafolio

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `GET` | `/portfolio-home` | `api` | Devuelve el bloque principal del portafolio: perfil, enlaces sociales, habilidades, destacados y experiencia. |
| `GET` | `/portfolio-home/hero` | `api` | Devuelve los datos mínimos para la carga inicial de la hero: perfil, enlaces sociales y expertise. |
| `GET` | `/laboratorio/home` | `api` | Devuelve los datos estructurados de presentación del laboratorio técnico. |
| `GET` | `/laboratorio` | `api` | Lista módulos e ítems activos del laboratorio. |
| `GET` | `/laboratorio/{id}` | `api` | Devuelve el detalle específico de un bloque o entorno del laboratorio. |
| `GET` | `/projects` | `api` | Lista los proyectos públicos desarrollados. |
| `GET` | `/projects/{id}` | `api` | Devuelve la ficha técnica y documentación de un proyecto. |
| `GET` | `/lab-capabilities` | `api` | Lista capacidades operacionales y de testing del laboratorio. |
| `GET` | `/research-sources` | `api` | Lista fuentes de datos, papers y documentación de soporte de I+D. |

### ✉️ Entrada de Datos (Contacto)

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/contact-messages` | `api` | Registra el mensaje en PostgreSQL (Neon) y envía una notificación inmediata mediante Resend. |

### 📝 Operaciones CRUD de Administración (Protegidas)

| Método | Endpoint | Middleware | Descripción |
| :--- | :--- | :--- | :--- |
| `POST` | `/projects` | `api`, `auth:sanctum` | Registra un nuevo proyecto en el portafolio. |
| `PUT` | `/projects/{id}` | `api`, `auth:sanctum` | Actualiza la información técnica de un proyecto existente. |
| `DELETE` | `/projects/{id}` | `api`, `auth:sanctum` | Elimina un proyecto del catálogo de forma permanente. |

---

## 🐋 Comandos de Control en Desarrollo Local (Docker + Git Bash)

Dado que las carpetas compartidas están enlazadas a tu volumen local, puedes usar estos comandos para controlar el contenedor `portfolio_backend`:

### Iniciar el contenedor local (recompilando cambios)

```bash
docker compose up -d --build
```

### Instalar dependencias en caliente

```bash
docker exec -it portfolio_backend composer require resend/resend-laravel
```

### Limpiar caché tras modificar el `.env` local

```bash
docker exec -it portfolio_backend php artisan config:clear
docker exec -it portfolio_backend php artisan cache:clear
```

### Ejecutar migraciones hacia la base de datos de desarrollo o producción

```bash
docker exec -it portfolio_backend php artisan migrate
```

---

## 🔒 Seguridad CORS (Cross-Origin Resource Sharing)

El backend implementa una política estricta de acceso en `config/cors.php` para mitigar usos no autorizados de la API:

- **Orígenes permitidos:** únicamente el entorno local (`http://localhost:5173`) y el dominio de producción del frontend (`https://portfolioalexsys.netlify.app`).
- **Cabeceras explícitas:** se evitan comodines (`*`) y solo se habilitan cabeceras esenciales como `Content-Type`, `Authorization` y `Accept`.
- **Optimización de red (`max_age`):** configurado a 24 horas (`86400` segundos) para cachear peticiones _Preflight OPTIONS_ y reducir latencia.
- **Soporte de credenciales:** habilitado mediante `supports_credentials: true` para permitir autenticación segura con tokens.

---

## 🧪 Pruebas de Integración y Seguridad (Rutas y Sanctum)

Puedes verificar el estado operativo de los endpoints y las restricciones de seguridad con `curl` desde Git Bash:

### 1. Comprobación del catálogo de proyectos (ruta pública)

```bash
curl -X GET http://localhost:8081/api/projects \
  -H "Accept: application/json"
```

### 2. Autenticación de administrador y captura de token

```bash
curl -X POST http://localhost:8081/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"alexandergalvez880208@gmail.com\", \"password\":\"tu_password_local\"}"
```

### 3. Validación de sesión protegida por token

_Si no envías el token devuelto en el paso anterior, el servidor responderá con `401 Unauthorized`._

```bash
curl -X GET http://localhost:8081/api/verify-auth \
  -H "Accept: application/json" \
  -H "Authorization: Bearer INSERTA_TU_TOKEN_AQUÍ"
```

---

## ⚙️ Consideraciones de Infraestructura y Automatización

1. **Bloqueo de puertos SMTP:** Render no permite tráfico SMTP saliente en capas gratuitas. El uso de Resend sobre HTTP/443 evita este problema sin introducir complejidad adicional.

2. **Límite de tiempo de respuesta:** Netlify puede abortar peticiones largas. Configurar `QUEUE_CONNECTION=sync` junto con Resend permite procesar el envío del correo de forma inmediata.

3. **Compilación en frío:** El `Dockerfile` puede ejecutar limpiezas automáticas de caché como `php artisan config:clear`, tolerando errores transitorios con sentencias de escape como `|| true` para mantener builds estables.

4. **Mitigación de cold starts en Render Free:** Dado que Render puede suspender servicios gratuitos tras unos 15 minutos sin tráfico, puede utilizarse un monitor HTTP externo, como **UptimeRobot**, apuntando a un endpoint ligero como `/health` con una frecuencia aproximada de **10 a 14 minutos**. Esta técnica reduce los arranques en frío, pero también incrementa el consumo de horas mensuales del plan gratuito.[web:527][web:546]

5. **Estrategia recomendada de disponibilidad:** Si se prioriza el ahorro de horas del plan gratuito, lo recomendable es pausar el monitor y aceptar _cold starts_ ocasionales. Si se necesita disponibilidad constante, la solución estable es migrar a una instancia de pago en Render.[web:527][web:544]

6. Ajuste del límite de memoria en PHP (memory_limit): Las imágenes oficiales de php:apache imponen límites estrictos de RAM que rompen procesos pesados de frameworks con paneles administrativos como Filament. Inyectar la directiva memory_limit=256M mediante un archivo .ini personalizado en el Dockerfile permite dar estabilidad a las peticiones concurrentes del backend.

7. Optimización de renderizado en producción (view:cache): Sustituir comandos de limpieza como view:clear por la pre-compilación de vistas (php artisan view:cache) durante la creación de la imagen de Docker disminuye los picos de CPU y RAM, evitando procesar código Blade en tiempo real ante las visitas de los usuarios.

8. Configuración de logs efímeros (LOG_CHANNEL=stderr): Almacenar registros en archivos locales (file) dentro de contenedores de Render satura la memoria interna y degrada el rendimiento. Configurar el canal de logs hacia stderr en las variables de entorno redirige el flujo de errores directamente a la consola nativa de Render en tiempo real, liberando RAM en el servidor.

9. Desactivación de trazas de depuración (APP_DEBUG=false): Mantener habilitadas las herramientas de debug en producción fuerza a Laravel a guardar en memoria RAM un historial detallado de excepciones y consultas SQL de cada petición. Forzar el entorno a production y desactivar el debug previene fugas de memoria (memory leaks).

10. Cierre explícito de conexiones persistentes (PDO::ATTR_PERSISTENT): Al conectar Laravel con bases de datos serverless como Neon DB, mantener hilos de conexión abiertos satura el pool de conexiones y eleva la RAM residual de Render. Definir la opción PDO::ATTR_PERSISTENT => false dentro del bloque pgsql obliga al framework a destruir el hilo con la base de datos inmediatamente después de despachar la respuesta HTTP.
