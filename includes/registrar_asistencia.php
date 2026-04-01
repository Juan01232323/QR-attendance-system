<?php
date_default_timezone_set('America/Mexico_City'); // Ajusta a tu zona horaria
require "../config/database.php";

$codigo = $_REQUEST['codigo'] ?? current($_REQUEST) ?? null;

if (!$codigo) {
    echo "Error: No se recibió ningún dato.";
    exit;
}

$sql = "SELECT * FROM empleados WHERE TRIM(qr_token) = :codigo OR id = :codigo";
$stmt = $conexion->prepare($sql);
$stmt->execute(['codigo' => trim($codigo)]);
$empleado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$empleado) {
    echo "Empleado no encontrado";
    exit;
}

$empleado_id = $empleado['id'];
$nombre = $empleado['nombre']; 
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sql = "SELECT * FROM asistencias 
        WHERE empleado_id = :empleado
        AND fecha = :fecha";

$stmt = $conexion->prepare($sql);
$stmt->execute([
    'empleado' => $empleado_id,
    'fecha' => $fecha
]);

$registro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$registro) {
    $retardo = 0;
    if ($hora > $empleado['hora_entrada']) {
        $retardo = 1;
    }

    $sql = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada, retardo)
            VALUES (:empleado, :fecha, :hora, :retardo)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        'empleado' => $empleado_id,
        'fecha' => $fecha,
        'hora' => $hora,
        'retardo' => $retardo 
    ]);

    $mensaje = $nombre . ($retardo ? " registró ENTRADA con RETARDO" : " registró ENTRADA");
    $stmt_notif = $conexion->prepare("INSERT INTO notificaciones(mensaje) VALUES(?)");
    $stmt_notif->execute([$mensaje]);

    echo $retardo ? "Entrada registrada con retardo" : "Entrada registrada";

} 
else {
    if ($registro['hora_salida'] == NULL) {
        
        // Validar que hayan pasado al menos 5 minutos desde la entrada
        $hora_entrada_unix = strtotime($registro['hora_entrada']);
        $hora_actual_unix = strtotime($hora);
        $diferencia_minutos = ($hora_actual_unix - $hora_entrada_unix) / 60;

        if ($diferencia_minutos < 5) {
            echo "Espera al menos 5 minutos para marcar salida (Llevas: " . round($diferencia_minutos, 1) . " min)";
            exit;
        }

        $sql = "UPDATE asistencias SET hora_salida = :hora WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            'hora' => $hora,
            'id' => $registro['id']
        ]);

        // Notificación de salida
        $mensaje = $nombre . " registró SALIDA";
        $stmt_notif = $conexion->prepare("INSERT INTO notificaciones(mensaje) VALUES(?)");
        $stmt_notif->execute([$mensaje]);

        echo "Salida registrada";
    } 
    else {
        echo "Asistencia ya registrada hoy (Entrada y Salida completas)";
    }
}
