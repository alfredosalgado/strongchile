<?php
header('Content-Type: text/plain; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acceso no autorizado.";
    exit;
}

// Configuración de correos para StrongChile
$todo_correo_destino = 'strongchile@strongchile.cl';
$todo_correo_origen  = 'no-reply@strongchile.cl';

// Leer todos los campos recibidos
$data = '';
foreach ($_POST as $key => $val) {
    $campo = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
    $valor = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    $data .= "$campo: $valor\n";
}

// Agregar información adicional
$data .= "\n--- Información adicional ---\n";
$data .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
$data .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
$data .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";

// Asunto del correo
$subject_raw = 'Nuevo mensaje de contacto desde StrongChile.cl';
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