<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once("Database.php");

$pdo = (new Database())->connect();

// Get the HTTP method of the request (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Split the request URI into parts using '/' as separator
// For example: /backend/api.php/criaturas/5 → ['backend', 'api.php', 'criaturas', '5']
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Get the resource requested (e.g., "criaturas")
// Adjusted to index 2 to match the URL structure
$recurso = $requestUri[2] ?? null;

// If there is an ID after the resource (e.g., /criaturas/3), get that ID
$id = $requestUri[3] ?? null;

if ($recurso !== 'criaturas') {
    http_response_code(404);
    echo json_encode(["mensaje" => "Recurso no encontrado"]);
    exit;
}

switch ($method) {
    case "GET":
        if ($id) {
            // If ID is provided, get the specific criatura
            $stmt = $pdo->prepare("SELECT * FROM criaturas WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();
            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404);
                echo json_encode(["mensaje" => "Criatura no encontrada"]);
            }
        } else {
            // If no ID, get all criaturas
            $query = $pdo->query("SELECT * FROM criaturas");
            $data = $query->fetchAll();
            echo json_encode($data);
        }
        break;

    default:
        echo json_encode(["error" => "Método no soportado"]);
}
?>
