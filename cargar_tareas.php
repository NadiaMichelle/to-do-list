
<?php
require 'conexion.php';
$result = $conn->query("SELECT * FROM tareas ORDER BY fecha_limite ASC");
$tareas = [];
while ($row = $result->fetch_assoc()) {
  $tareas[] = $row;
}
echo json_encode($tareas);
?>
