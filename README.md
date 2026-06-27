<p align="center">
  <img src="https://githubusercontent.com" width="350" alt="Laravel Logo">
</p>

# 🚀 Portfolio Backend — API REST (Laravel & Docker Native)

Este repositorio contiene el backend y la API REST que gestiona toda la información, datos dinámicos y mensajería de mi sitio web de portafolio profesional. Está diseñado bajo una arquitectura de infraestructura inmutable empaquetada al 100% en contenedores.

🔗 **Frontend (Netlify):** [https://netlify.app](https://netlify.app)  
🔗 **Backend API (Render):** [https://onrender.com](https://onrender.com)

---

## 🛠️ Arquitectura de Despliegue Automatizado

El sistema utiliza servicios en la nube con capas gratuitas optimizadas y está estructurado para ejecutarse sin necesidad de mantenimiento o intervención en la shell del servidor:

*   **Framework:** Laravel (PHP 8.4) configurado exclusivamente como API REST.
*   **Servidor Web (Producción):** **Render** (Plan Free Web Service) configurado en modo **Docker Deployment**. Se compila de forma automatizada leyendo el `Dockerfile` del repositorio en cada *git push*.
*   **Base de Datos:** **Neon DB** (Serverless PostgreSQL) integrada nativamente a través de la extensión `pdo_pgsql`.
*   **Servicio de Correo:** **Resend API** configurado en envío síncrono. Viaja de forma nativa por HTTP (Puerto 443) eludiendo por completo el bloqueo estricto de puertos SMTP (25, 465, 587) que aplica Render en sus servicios gratuitos.
*   **Administración Interna:** Filament PHP integrado para control total de contenidos.

---

## 📋 Variables de Entorno en el Panel de Render (`Environment`)

Debido a que Render destruye y reconstruye el contenedor en cada despliegue, las siguientes llaves se configuran directamente en la sección **Environment** de la interfaz web de Render (nunca se suben al repositorio):

```env
DB_CONNECTION=pgsql
DB_HOST=ep-your-neon-domain.pooler.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=alexandergalvez880208
DB_PASSWORD=tu_contraseña_secreta_de_neon

# Forzar envío síncrono por la ausencia de Background Workers en planes Free
QUEUE_CONNECTION=sync

# Autenticación segura basada en API HTTP (Puerto 443)
MAIL_MAILER=resend
RESEND_API_KEY=re_tu_llave_secreta_de_resend
MAIL_FROM_ADDRESS=onboarding@resend.dev
MAIL_FROM_NAME="Portfolio Alex"
```

---

## 🐋 Gestión en Desarrollo Local (Docker Compose)

En entorno local (Windows utilizando Git Bash), las dependencias y la base de datos se orquestan de forma local.

### Levantar o actualizar el entorno local:
```bash
docker compose up -d --build
```

### Instalar nuevos paquetes dentro del contenedor activo:
```bash
docker exec -it portfolio_backend composer require resend/resend-laravel
```

### Ejecutar migraciones en Neon desde tu entorno local:
```bash
docker exec -it portfolio_backend php artisan migrate
```

---

## ⚙️ Notas de Automatización e Infraestructura Inmutable

1.  **Limpieza de Caché Automatizada:** El `Dockerfile` incluye comandos de optimización en la etapa de construcción (`php artisan config:clear`). Esto asegura que cualquier cambio en las variables de entorno de Render tome efecto inmediatamente en el servidor web Apache sin necesidad de entrar a una consola.
2.  **Manejo de Tiempos de Espera (Netlify Timeout):** Netlify aborta peticiones que superen los **26 segundos**. Al usar el driver de Resend junto con `QUEUE_CONNECTION=sync`, Laravel delega el procesamiento del email mediante llamadas web ultrarrápidas, respondiendo al Frontend en milisegundos y previniendo caídas por *timeout*.
3.  **Seguridad en el Flujo de Correos:** En producción el remitente se bloquea estrictamente en `onboarding@resend.dev` (exigencia de la capa gratuita de Resend). Las respuestas directas del correo se gestionan dinámicamente mediante la cabecera `replyTo` inyectada en el Mailable de Laravel con los datos capturados en el formulario.
