# Sitio Web StrongChile

Este es el repositorio del código para el sitio web de una sola página (one-page) de StrongChile, una empresa especializada en la fabricación de bobinas y conductores eléctricos. El sitio fue desarrollado para ser profesional, moderno y completamente responsivo.

## ✨ Características Principales

-   **Diseño Responsivo:** Se adapta perfectamente a cualquier dispositivo, desde teléfonos móviles hasta monitores de escritorio.
-   **Navegación Fija y Dinámica:** La barra de navegación es transparente al inicio y se vuelve sólida al hacer scroll para una mejor visibilidad.
-   **Desplazamiento Suave (Smooth Scrolling):** Al hacer clic en los enlaces del menú, la página se desplaza suavemente a la sección correspondiente.
-   **Componentes Interactivos:**
    -   Sección de servicios con diseño alternado y botones de cotización directa a WhatsApp.
    -   Galería de procesos con tarjetas (cards) que tienen efectos visuales al pasar el cursor.
-   **Formulario de Contacto:** Un formulario de contacto funcional (simulado en el frontend) para que los clientes puedan enviar consultas.
-   **Integración con API Externas:**
    -   **WhatsApp:** Enlaces directos para iniciar una conversación con mensajes predefinidos.
    -   **Google Maps:** Un mapa embebido que muestra la ubicación física de la empresa.
-   **Botones Flotantes de Acción:**
    -   Un botón de WhatsApp siempre visible para un contacto rápido.
    -   Un botón de "Volver Arriba" que aparece dinámicamente al hacer scroll.

## 🛠️ Estructura del Proyecto

El proyecto está organizado en tres archivos principales:

-   `index.html`: Contiene toda la estructura y el contenido del sitio web.
-   `style.css`: Almacena los estilos CSS personalizados básicos. La mayor parte del diseño se maneja con clases de Tailwind CSS directamente en el HTML.
-   `script.js`: Incluye toda la lógica de JavaScript para la interactividad del sitio.

## 🚀 Tecnologías Utilizadas

-   **HTML5:** Para la estructura semántica del contenido.
-   **CSS3 (con Tailwind CSS v3):** Se utiliza principalmente el framework Tailwind CSS a través de su CDN para un diseño rápido y responsivo. Los estilos personalizados mínimos se encuentran en `style.css`.
-   **JavaScript (Vanilla JS):** No se utilizan frameworks de JavaScript. Todo el código de interactividad es JavaScript puro para mantener el sitio ligero y rápido.
-   **Google Fonts:** Para la tipografía profesional (fuente "Inter").
-   **Font Awesome:** Para la iconografía utilizada en todo el sitio.

## 💻 Cómo Usar

1.  Asegúrate de tener los tres archivos (`index.html`, `style.css`, `script.js`) en la misma carpeta.
2.  Abre el archivo `index.html` en cualquier navegador web moderno (como Chrome, Firefox, o Edge).
3.  **Importante:** Se requiere una conexión a internet para que las librerías externas (Tailwind CSS, Google Fonts, Font Awesome) se carguen correctamente desde sus CDNs.