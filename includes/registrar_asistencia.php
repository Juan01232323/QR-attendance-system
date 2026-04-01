<?php

require "../config/database.php";

$codigo = $_GET['codigo']; 

$sql = "SELECT * FROM empleados WHERE qr_token = :codigo";
$stmt = $conexion->prepare($sql);
$stmt->execute(['codigo'=>$codigo]);
$empleado = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$empleado){
    echo "Empleado no encontrado";
    exit;
}

$empleado_id = $empleado['id'];
$nombre = $empleado['nombre']; // Asegúrate de tener esta variable para la notificación
$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sql = "SELECT * FROM asistencias 
        WHERE empleado_id = :empleado
        AND fecha = :fecha";

$stmt = $conexion->prepare($sql);
$stmt->execute([
    'empleado'=>$empleado_id,
    'fecha'=>$fecha
]);

$registro = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$registro){
    // --- PASO 3: DETECTAR RETARDO AUTOMÁTICAMENTE ---
    $retardo = 0;
    // Comparamos la hora actual con la 'hora_entrada' oficial del empleado en la DB
    if($hora > $empleado['hora_entrada']){
        $retardo = 1;
    }

    // --- PASO 4: GUARDAR ASISTENCIA CON RETARDO ---
    $sql = "INSERT INTO asistencias 
            (empleado_id, fecha, hora_entrada, retardo)
            VALUES (:empleado, :fecha, :hora, :retardo)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        'empleado'=>$empleado_id,
        'fecha'=>$fecha,
        'hora'=>$hora,
        'retardo'=>$retardo // Guardamos el 0 o 1 detectado
    ]);

    // Notificación dinámica
    $mensaje = $nombre . ($retardo ? " registró ENTRADA con RETARDO" : " registró ENTRADA");
    $stmt_notif = $conexion->prepare("INSERT INTO notificaciones(mensaje) VALUES(?)");
    $stmt_notif->execute([$mensaje]);

    echo $retardo ? "Entrada registrada con retardo" : "Entrada registrada";

}else{
    if($registro['hora_salida'] == NULL){
        $sql = "UPDATE asistencias
                SET hora_salida = :hora
                WHERE id = :id";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            'hora'=>$hora,
            'id'=>$registro['id']
        ]);

        $mensaje = $nombre . " registró SALIDA";
        $stmt_notif = $conexion->prepare("INSERT INTO notificaciones(mensaje) VALUES(?)");
        $stmt_notif->execute([$mensaje]);

        echo "Salida registrada";
    }else{
        echo "Asistencia ya registrada hoy";
    }
}
