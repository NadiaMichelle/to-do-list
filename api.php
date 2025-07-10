<?php
header('Content-Type: application/json');

require_once 'conexion.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $result = $conn->query("SELECT * FROM tareas ORDER BY fecha_limite ASC");
        $tareas = [];
        while ($row = $result->fetch_assoc()) {
            $tareas[] = $row;
        }
        echo json_encode($tareas);
        break;
        
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $descripcion = $input['descripcion'];
        $fecha_limite = $input['fecha_limite'];
        
        $stmt = $conn->prepare("INSERT INTO tareas (descripcion, fecha_limite) VALUES (?, ?)");
        $stmt->bind_param("ss", $descripcion, $fecha_limite);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error']);
        }
        break;
        
    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $completada = $input['completada'];
        
        $stmt = $conn->prepare("UPDATE tareas SET completada = ? WHERE id = ?");
        $stmt->bind_param("ii", $completada, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error']);
        }
        break;
        
    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error']);
        }
        break;
}

$conn->close();
?>