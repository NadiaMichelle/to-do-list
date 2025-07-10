
<?php
$conn = new mysqli("localhost", "root", "", "todolis");
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
