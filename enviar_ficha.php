<?php
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Configuración de correo
$to = 'strongchile@strongchile.cl';
$subject = 'Nueva Ficha Técnica - StrongChile';
$from = 'noreply@strongchile.cl';
$reply_to = isset($_POST['email']) ? $_POST['email'] : $from;

// Recopilar datos del formulario
$datos = [
    // Información básica
    'nombre' => $_POST['nombre'] ?? '',
    'fecha' => $_POST['fecha'] ?? '',
    'numero_orden' => $_POST['numero_orden'] ?? '',
    'pais' => $_POST['pais'] ?? '',
    'telefono' => $_POST['telefono'] ?? '',
    'email' => $_POST['email'] ?? '',
    'fax' => $_POST['fax'] ?? '',
    
    // Identificación del motor
    'planta' => $_POST['planta'] ?? '',
    'numero_fabricacion' => $_POST['numero_fabricacion'] ?? '',
    'potencia' => $_POST['potencia'] ?? '',
    'numero_motor' => $_POST['numero_motor'] ?? '',
    'numero_polos' => $_POST['numero_polos'] ?? '',
    'clase_aislamiento' => $_POST['clase_aislamiento'] ?? '',
    'marca' => $_POST['marca'] ?? '',
    'voltios' => $_POST['voltios'] ?? '',
    'sobre_elev_temp' => $_POST['sobre_elev_temp'] ?? '',
    'modelo' => $_POST['modelo'] ?? '',
    'amperios' => $_POST['amperios'] ?? '',
    'cosfi' => $_POST['cosfi'] ?? '',
    'frame' => $_POST['frame'] ?? '',
    'fases' => $_POST['fases'] ?? '',
    'velocidad' => $_POST['velocidad'] ?? '',
    'numero_serial' => $_POST['numero_serial'] ?? '',
    'frecuencia' => $_POST['frecuencia'] ?? '',
    
    // Datos de devanado
    'numero_ranuras' => $_POST['numero_ranuras'] ?? '',
    'paso_bobina' => $_POST['paso_bobina'] ?? '',
    'numero_circuitos_conexiones' => $_POST['numero_circuitos_conexiones'] ?? '',
    'tipo_conexion' => $_POST['tipo_conexion'] ?? '',
    'medida_conductor' => $_POST['medida_conductor'] ?? '',
    'conductores_paralelo' => $_POST['conductores_paralelo'] ?? '',
    'aislamiento_esmaltado' => isset($_POST['aislamiento_esmaltado']) ? 'Sí' : 'No',
    'aislamiento_vidrio' => isset($_POST['aislamiento_vidrio']) ? 'Sí' : 'No',
    'aislamiento_mica' => isset($_POST['aislamiento_mica']) ? 'Sí' : 'No',
    'espiras_bobina' => $_POST['espiras_bobina'] ?? '',
    'vueltas' => $_POST['vueltas'] ?? '',
    'bobinas_grupo' => $_POST['bobinas_grupo'] ?? '',
    
    // Características especiales
    'cambio_datos' => isset($_POST['cambio_datos']) ? ($_POST['cambio_datos'] == 'si' ? 'Sí' : 'No') : '',
    'salidas_estanadas' => isset($_POST['salidas_estanadas']) ? ($_POST['salidas_estanadas'] == 'si' ? 'Sí' : 'No') : '',
    'vueltas_aislacion' => isset($_POST['vueltas_aislacion']) ? ($_POST['vueltas_aislacion'] == 'si' ? 'Sí' : 'No') : '',
    'salidas_encintadas' => isset($_POST['salidas_encintadas']) ? ($_POST['salidas_encintadas'] == 'si' ? 'Sí' : 'No') : '',
    'ranuras_oblicuas' => isset($_POST['ranuras_oblicuas']) ? ($_POST['ranuras_oblicuas'] == 'si' ? 'Sí' : 'No') : '',
    'proteccion_corona' => isset($_POST['proteccion_corona']) ? ($_POST['proteccion_corona'] == 'si' ? 'Sí' : 'No') : '',
    'cada_critica_recodo' => isset($_POST['cada_critica_recodo']) ? ($_POST['cada_critica_recodo'] == 'si' ? 'Sí' : 'No') : '',
    'aislante_ranura' => isset($_POST['aislante_ranura']) ? ($_POST['aislante_ranura'] == 'si' ? 'Sí' : 'No') : '',
    'cercania_tapas' => isset($_POST['cercania_tapas']) ? ($_POST['cercania_tapas'] == 'si' ? 'Sí' : 'No') : '',
    'rtd_uso_ohms' => $_POST['rtd_uso_ohms'] ?? '',
    'cantidad' => $_POST['cantidad'] ?? '',
    'cunas' => $_POST['cunas'] ?? '',
    'unidad_terminada' => $_POST['unidad_terminada'] ?? '',
    'resina_barniz' => $_POST['resina_barniz'] ?? '',
    
    // Dimensiones del núcleo
    'diametro_interior_nucleo' => $_POST['diametro_interior_nucleo'] ?? '',
    'largo_nucleo' => $_POST['largo_nucleo'] ?? '',
    'ancho_prensanucleo' => $_POST['ancho_prensanucleo'] ?? '',
    'profundidad_total_ranura' => $_POST['profundidad_total_ranura'] ?? '',
    'profundidad_debajo_cuna' => $_POST['profundidad_debajo_cuna'] ?? '',
    'ancho_ranura' => $_POST['ancho_ranura'] ?? '',
    
    // Dimensiones de la bobina
    'caida_cabeza_bobina_pequena' => $_POST['caida_cabeza_bobina_pequena'] ?? '',
    'caida_cabeza_bobina_larga' => $_POST['caida_cabeza_bobina_larga'] ?? '',
    'vuelo_cabeza_bobina_conexion' => $_POST['vuelo_cabeza_bobina_conexion'] ?? '',
    'vuelo_cabeza_bobina_opuesto' => $_POST['vuelo_cabeza_bobina_opuesto'] ?? '',
    'longitud_area_recta_bobina_abajo' => $_POST['longitud_area_recta_bobina_abajo'] ?? '',
    'longitud_area_recta_bobina_arriba' => $_POST['longitud_area_recta_bobina_arriba'] ?? '',
    'longitud_total_bobina' => $_POST['longitud_total_bobina'] ?? '',
    'altura_total_superficie_mesa' => $_POST['altura_total_superficie_mesa'] ?? '',
    'dimension_cuerda' => $_POST['dimension_cuerda'] ?? '',
    'longitud_total_bobina_campo1' => $_POST['longitud_total_bobina_campo1'] ?? '',
    'longitud_total_bobina_campo2' => $_POST['longitud_total_bobina_campo2'] ?? '',
    'longitud_total_bobina_campo3' => $_POST['longitud_total_bobina_campo3'] ?? '',
    'longitud_total_bobina_campo4' => $_POST['longitud_total_bobina_campo4'] ?? '',
    'longitud_total_bobina_campo5' => $_POST['longitud_total_bobina_campo5'] ?? '',
    'longitud_total_bobina_campo6' => $_POST['longitud_total_bobina_campo6'] ?? '',
    
    // Tipo de aislante (checkboxes)
    'tratado_barniz_f' => isset($_POST['tratado_barniz_f']) ? 'Sí' : 'No',
    'tratado_barniz_h' => isset($_POST['tratado_barniz_h']) ? 'Sí' : 'No',
    'tratado_vpi' => isset($_POST['tratado_vpi']) ? 'Sí' : 'No',
    'tratado_omniseal' => isset($_POST['tratado_omniseal']) ? 'Sí' : 'No',
    'tratado_omniseal_plus' => isset($_POST['tratado_omniseal_plus']) ? 'Sí' : 'No',
    
    // Posición de los terminales
    'posicion_terminales' => isset($_POST['posicion_terminales']) ? $_POST['posicion_terminales'] : 'No seleccionado',
];

// Información adicional
$fecha_envio = date('d/m/Y H:i:s');
$ip_cliente = $_SERVER['REMOTE_ADDR'] ?? 'No disponible';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'No disponible';

// Construir el mensaje HTML
$message = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Nueva Ficha Técnica - StrongChile</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { background-color: #1f2937; color: white; padding: 20px; text-align: center; }
        .section { margin: 20px 0; padding: 15px; border-left: 4px solid #fbbf24; background-color: #f9fafb; }
        .section h3 { margin-top: 0; color: #1f2937; }
        .field { margin: 8px 0; }
        .field strong { color: #374151; }
        .footer { background-color: #f3f4f6; padding: 15px; margin-top: 20px; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Nueva Ficha Técnica</h1>
            <p>Bobinas y Conductores StrongChile S.A.</p>
        </div>
        
        <div class='section'>
            <h3>Información Básica</h3>
            <div class='field'><strong>Nombre:</strong> {$datos['nombre']}</div>
            <div class='field'><strong>Fecha:</strong> {$datos['fecha']}</div>
            <div class='field'><strong>Número de orden:</strong> {$datos['numero_orden']}</div>
            <div class='field'><strong>País:</strong> {$datos['pais']}</div>
            <div class='field'><strong>Teléfono:</strong> {$datos['telefono']}</div>
            <div class='field'><strong>Email:</strong> {$datos['email']}</div>
            <div class='field'><strong>Fax:</strong> {$datos['fax']}</div>
        </div>
        
        <div class='section'>
            <h3>Identificación del Motor</h3>
            <div class='field'><strong>Planta:</strong> {$datos['planta']}</div>
            <div class='field'><strong>N° Fabricación:</strong> {$datos['numero_fabricacion']}</div>
            <div class='field'><strong>Potencia:</strong> {$datos['potencia']}</div>
            <div class='field'><strong># Motor:</strong> {$datos['numero_motor']}</div>
            <div class='field'><strong>N° Polos:</strong> {$datos['numero_polos']}</div>
            <div class='field'><strong>Clase de Aislamiento:</strong> {$datos['clase_aislamiento']}</div>
            <div class='field'><strong>Marca:</strong> {$datos['marca']}</div>
            <div class='field'><strong>Voltios:</strong> {$datos['voltios']}</div>
            <div class='field'><strong>Sobre Elev. Temp.:</strong> {$datos['sobre_elev_temp']}</div>
            <div class='field'><strong>Modelo:</strong> {$datos['modelo']}</div>
            <div class='field'><strong>Amperios:</strong> {$datos['amperios']}</div>
            <div class='field'><strong>Cosφ:</strong> {$datos['cosfi']}</div>
            <div class='field'><strong>Frame:</strong> {$datos['frame']}</div>
            <div class='field'><strong>Fases:</strong> {$datos['fases']}</div>
            <div class='field'><strong>Velocidad:</strong> {$datos['velocidad']}</div>
            <div class='field'><strong>N° Serial:</strong> {$datos['numero_serial']}</div>
            <div class='field'><strong>Frecuencia (Hz):</strong> {$datos['frecuencia']}</div>
        </div>
        
        <div class='section'>
            <h3>Datos de Devanado</h3>
            <div class='field'><strong>N° de ranuras:</strong> {$datos['numero_ranuras']}</div>
            <div class='field'><strong>Paso de bobina:</strong> {$datos['paso_bobina']}</div>
            <div class='field'><strong>N° de circuitos y conexiones:</strong> {$datos['numero_circuitos_conexiones']}</div>
            <div class='field'><strong>Tipo de conexión:</strong> {$datos['tipo_conexion']}</div>
            <div class='field'><strong>Medida del conductor:</strong> {$datos['medida_conductor']}</div>
            <div class='field'><strong>Conductores en paralelo:</strong> {$datos['conductores_paralelo']}</div>
            <div class='field'><strong>Aislamiento Esmaltado:</strong> {$datos['aislamiento_esmaltado']}</div>
            <div class='field'><strong>Aislamiento Vidrio:</strong> {$datos['aislamiento_vidrio']}</div>
            <div class='field'><strong>Aislamiento Mica:</strong> {$datos['aislamiento_mica']}</div>
            <div class='field'><strong>N° de espiras por bobina:</strong> {$datos['espiras_bobina']}</div>
            <div class='field'><strong>Vueltas:</strong> {$datos['vueltas']}</div>
            <div class='field'><strong>Bobinas por Grupo:</strong> {$datos['bobinas_grupo']}</div>
        </div>
        
        <div class='section'>
             <h3>Características Especiales</h3>
             <div class='field'><strong>Cambio de datos:</strong> {$datos['cambio_datos']}</div>
             <div class='field'><strong>Salidas estañadas:</strong> {$datos['salidas_estanadas']}</div>
             <div class='field'><strong>Vueltas de aislación:</strong> {$datos['vueltas_aislacion']}</div>
             <div class='field'><strong>Salidas encintadas:</strong> {$datos['salidas_encintadas']}</div>
             <div class='field'><strong>Ranuras oblicuas:</strong> {$datos['ranuras_oblicuas']}</div>
             <div class='field'><strong>Protección corona:</strong> {$datos['proteccion_corona']}</div>
             <div class='field'><strong>Cada crítica del recodo:</strong> {$datos['cada_critica_recodo']}</div>
             <div class='field'><strong>Aislante en la ranura:</strong> {$datos['aislante_ranura']}</div>
             <div class='field'><strong>Cercanía de tapas:</strong> {$datos['cercania_tapas']}</div>
             <div class='field'><strong>R.T.D. en uso (OH MS):</strong> {$datos['rtd_uso_ohms']}</div>
                <div class='field'><strong>Cantidad:</strong> {$datos['cantidad']}</div>
             <div class='field'><strong>Cuñas:</strong> {$datos['cunas']}</div>
             <div class='field'><strong>Unidad terminada y procesada en:</strong> {$datos['unidad_terminada']}</div>
             <div class='field'><strong>Resina/Barniz:</strong> {$datos['resina_barniz']}</div>
         </div>
        
        <div class='section'>
            <h3>Dimensiones del Núcleo</h3>
            <div class='field'><strong>1. Diámetro interior del núcleo:</strong> {$datos['diametro_interior_nucleo']}</div>
            <div class='field'><strong>2. Largo del núcleo:</strong> {$datos['largo_nucleo']}</div>
            <div class='field'><strong>3. Ancho del prensanúcleo:</strong> {$datos['ancho_prensanucleo']}</div>
            <div class='field'><strong>4. Profundidad total de la ranura:</strong> {$datos['profundidad_total_ranura']}</div>
            <div class='field'><strong>5. Profundidad por debajo de la cuña:</strong> {$datos['profundidad_debajo_cuna']}</div>
            <div class='field'><strong>6. Ancho de la ranura:</strong> {$datos['ancho_ranura']}</div>
        </div>
        
        <div class='section'>
            <h3>Dimensiones de la Bobina</h3>
            <div class='field'><strong>7. Caída de la cabeza de bobina pequeña:</strong> {$datos['caida_cabeza_bobina_pequena']}</div>
            <div class='field'><strong>8. Caída de la cabeza de bobina larga:</strong> {$datos['caida_cabeza_bobina_larga']}</div>
            <div class='field'><strong>9. Vuelo cabeza-bobina lado conexión:</strong> {$datos['vuelo_cabeza_bobina_conexion']}</div>
            <div class='field'><strong>10. Vuelo cabeza bobina por el lado opuesto:</strong> {$datos['vuelo_cabeza_bobina_opuesto']}</div>
            <div class='field'><strong>11. Longitud por el área recta de la bobina por abajo:</strong> {$datos['longitud_area_recta_bobina_abajo']}</div>
            <div class='field'><strong>12. Longitud por el área recta de la bobina por arriba:</strong> {$datos['longitud_area_recta_bobina_arriba']}</div>
            <div class='field'><strong>13. Longitud total de la bobina:</strong> {$datos['longitud_total_bobina']}</div>
            <div class='field'><strong>14. Altura total desde la superficie de la mesa:</strong> {$datos['altura_total_superficie_mesa']}</div>
            <div class='field'><strong>15. Dimensión de la cuerda:</strong> {$datos['dimension_cuerda']}</div>
            <div class='field'><strong>16. Longitud total de la bobina (Campo 1):</strong> {$datos['longitud_total_bobina_campo1']}</div>
            <div class='field'><strong>17. Longitud total de la bobina (Campo 2):</strong> {$datos['longitud_total_bobina_campo2']}</div>
            <div class='field'><strong>18. Longitud total de la bobina (Campo 3):</strong> {$datos['longitud_total_bobina_campo3']}</div>
            <div class='field'><strong>19. Longitud total de la bobina (Campo 4):</strong> {$datos['longitud_total_bobina_campo4']}</div>
            <div class='field'><strong>20. Longitud total de la bobina (Campo 5):</strong> {$datos['longitud_total_bobina_campo5']}</div>
            <div class='field'><strong>21. Longitud total de la bobina (Campo 6):</strong> {$datos['longitud_total_bobina_campo6']}</div>
        </div>
        
        <div class='section'>
            <h3>Tipo de Aislante</h3>
            <div class='field'><strong>Tratado de barniz "F":</strong> {$datos['tratado_barniz_f']}</div>
            <div class='field'><strong>Tratado de barniz "H":</strong> {$datos['tratado_barniz_h']}</div>
            <div class='field'><strong>Tratado de VPI:</strong> {$datos['tratado_vpi']}</div>
            <div class='field'><strong>Tratado de Omniseal:</strong> {$datos['tratado_omniseal']}</div>
            <div class='field'><strong>Tratado de Omniseal Plus:</strong> {$datos['tratado_omniseal_plus']}</div>
        </div>
        
        <div class='section'>
            <h3>Posición de los Terminales</h3>
            <div class='field'><strong>Posición:</strong> {$datos['posicion_terminales']}</div>
        </div>
        
        <div class='footer'>
            <p><strong>Información del envío:</strong></p>
            <p>Fecha y hora: {$fecha_envio}</p>
            <p>IP del cliente: {$ip_cliente}</p>
            <p>Navegador: {$user_agent}</p>
        </div>
    </div>
</body>
</html>
";

// Headers para el correo
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: {$from}" . "\r\n";
$headers .= "Reply-To: {$reply_to}" . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Enviar el correo
if (mail($to, $subject, $message, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => '¡Ficha técnica enviada correctamente! Nos pondremos en contacto contigo pronto.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al enviar la ficha técnica. Por favor, inténtalo de nuevo.'
    ]);
}
?>