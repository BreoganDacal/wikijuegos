<?php
require 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

// Determinar si la solicitud es para 'usuarios' o 'materias'
$entity = null;
$id = null;
$parts = explode('/', $requestUri);
foreach ($parts as $index => $part) {
    if ($part === 'usuarios' || $part === 'materias') {
        $entity = $part;
        if (isset($parts[$index + 1])) {
            $id = $parts[$index + 1];
        }
        break;
    }
}

$input = json_decode(file_get_contents("php://input"), true);

if (!$entity) {
    http_response_code(400);
    echo json_encode(["mensaje" => "Entidad no especificada"]);
    exit;
}

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM $entity");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
        
    case 'POST':
        if ($entity === 'usuarios') {
            if (!isset($input['nombre'], $input['email'])) {
                http_response_code(400);
                echo json_encode(["mensaje" => "Nombre y email requeridos"]);
                exit;
            }
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
            $stmt->execute([$input['nombre'], $input['email']]);
            echo json_encode(["id" => $pdo->lastInsertId(), "nombre" => $input['nombre'], "email" => $input['email']]);
        } elseif ($entity === 'materias') {
            if (!isset($input['nombre'], $input['descripcion'], $input['profesor'])) {
                http_response_code(400);
                echo json_encode(["mensaje" => "Todos los campos son requeridos"]);
                exit;
            }
            $stmt = $pdo->prepare("INSERT INTO materias (nombre, descripcion, profesor) VALUES (?, ?, ?)");
            $stmt->execute([$input['nombre'], $input['descripcion'], $input['profesor']]);
            echo json_encode(["idmaterias" => $pdo->lastInsertId(), "nombre" => $input['nombre'], "descripcion" => $input['descripcion'], "profesor" => $input['profesor']]);
        }
        exit;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["mensaje" => "ID requerido"]);
            exit;
        }
        $stmt = $pdo->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["mensaje" => ucfirst($entity) . " eliminado"]);
        exit;

    default:
        http_response_code(405);
        echo json_encode(["mensaje" => "Método no permitido"]);
        exit;
}
?>
