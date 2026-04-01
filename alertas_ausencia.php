<?php

require "config/database.php";
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

$fecha=date("Y-m-d");

$sql="SELECT nombre FROM empleados
WHERE id NOT IN(
SELECT empleado_id FROM asistencias WHERE fecha=:fecha
)";

$stmt=$conexion->prepare($sql);
$stmt->execute(['fecha'=>$fecha]);

$faltantes=$stmt->fetchAll(PDO::FETCH_ASSOC);

if(!$faltantes) exit;

$mail=new PHPMailer();

$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='correo@gmail.com';
$mail->Password='password';
$mail->SMTPSecure='tls';
$mail->Port=587;

$mail->setFrom('sistema@empresa.com');
$mail->addAddress('rh@empresa.com');

$mail->Subject="Empleados sin asistencia";

$mensaje="No registraron asistencia:\n";

foreach($faltantes as $f){

$mensaje.=$f['nombre']."\n";

}

$mail->Body=$mensaje;

$mail->send();