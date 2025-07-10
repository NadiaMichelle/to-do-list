
<?php
require 'conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM tareas WHERE id = $id");
?>
