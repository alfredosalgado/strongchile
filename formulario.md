# Instrucciones para Implementar Funcionalidad de Formulario de Contacto

## 1. Localizar archivos

- Encuentra el HTML con tu `<form id="formContacto">…</form>` (o el id que uses)
- Localiza el archivo JavaScript principal (por ejemplo `script.js`)
- Localiza tu hoja de estilos global (`style.css`)

## 2. Modificaciones en HTML

### Verificar charset
Verifica que en `<head>` exista:
```html
<meta charset="utf-8">
```

### Script JavaScript
Asegura que tu `<body>` incluya al final:
```html
<script src="script.js"></script>
```

## 3. JavaScript: envío AJAX y feedback

En tu `script.js`, agrega o complementa un listener así:

```javascript
const form = document.getElementById('formContacto');

if (form) {
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const data = new FormData(form);
    
    try {
      const res = await fetch('enviar.php', { method: 'POST', body: data });
      const text = await res.text();
      
      if (text.trim() === 'Mensaje enviado correctamente.') {
        // Usar el sistema de mensajes existente de la página
        showMessage('¡Mensaje enviado correctamente! Nos pondremos en contacto contigo pronto.', 'success');
        form.reset();
      } else {
        showMessage(text, 'error');
      }
    } catch (err) {
      console.error(err);
      showMessage('Error en la petición. Por favor, intenta nuevamente.', 'error');
    }
  });
}
```

### Notas importantes:
- `fetch('enviar.php')`: llama al script PHP
- `text.trim()`: compara exactamente con el mensaje de éxito
- Usar `showMessage()` en lugar de popup para aprovechar el sistema de mensajes existente

## 4. Crear enviar.php en la raíz

Genera un archivo `enviar.php` con la siguiente plantilla genérica:

```php
<?php
header('Content-Type: text/plain; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acceso no autorizado.";
    exit;
}

// Adaptar estas variables al proyecto
$todo_correo_destino = 'destino@dominio.cl';
$todo_correo_origen  = 'no-reply@dominio.cl';

// Leer todos los campos recibidos
$data = '';
foreach ($_POST as $key => $val) {
    $campo = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
    $valor = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    $data .= "$campo: $valor\n";
}

// Asunto genérico, sin entrar en campos específicos
$subject_raw = 'Nuevo formulario desde ' . $_SERVER['HTTP_HOST'];
$subject     = '=?UTF-8?B?' . base64_encode($subject_raw) . '?=';

// Cabeceras UTF-8
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";
$headers .= "From: $todo_correo_origen\r\n";
$headers .= "Reply-To: $todo_correo_origen\r\n";

if (mail($todo_correo_destino, $subject, $data, $headers)) {
    echo 'Mensaje enviado correctamente.';
} else {
    echo 'Error al enviar el correo. Intenta más tarde.';
}
?>
```

## Requisitos del servidor

Para que el formulario funcione completamente, necesitas:
1. **Servidor web con PHP** (Apache, Nginx, etc.)
2. **Configuración SMTP** en el servidor para envío de emails
3. **Permisos** para la función `mail()` de PHP

## Personalización

- Modifica `$todo_correo_destino` con el email de destino real
- Modifica `$todo_correo_origen` con el email de origen apropiado
- Ajusta el ID del formulario si es diferente a `formContacto`
- Personaliza los mensajes de éxito y error según tu diseño