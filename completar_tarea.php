
<?php
require 'conexion.php';
$id = $_GET['id'];
$conn->query("UPDATE tareas SET completada = 1 WHERE id = $id");
?>
