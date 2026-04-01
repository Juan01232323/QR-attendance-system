<?php

require "../config/database.php";

$sql = "SELECT * FROM notificaciones
ORDER BY fecha DESC
LIMIT 5";

$stmt = $conexion->query($sql);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));