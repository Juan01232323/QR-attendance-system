<?php

$host = "localhost";
$dbname = "control_asistencias_qr";
$user = "root";
$password = "juan123456"; // Prueba con "root" o déjalo vacío ""


try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "Error de conexión: " . $e->getMessage();
}
?>