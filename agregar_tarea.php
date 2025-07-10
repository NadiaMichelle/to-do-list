
<?php
require 'conexion.php';
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$stmt = $conn->prepare("INSERT INTO tareas (descripcion, fecha_limite) VALUES (?, ?)");
$stmt->bind_param("ss", $descripcion, $fecha);
$stmt->execute();
?>
