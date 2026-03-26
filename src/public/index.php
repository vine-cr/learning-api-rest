<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/config.php';

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

in_array($origin, $allowedOrigins) ? header("Access-Control-Allow-Origin: $origin") : null;

header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}


$uri = strtok($_SERVER['REQUEST_URI'], '?');

if ($uri === '/api/users') {
    require __DIR__ . '/../src/api.php';
} 
elseif ($uri === '/docs') {
    header('Content-Type: text/html');
    echo file_get_contents(__DIR__ . '/../views/docs.html');
} 
elseif ($uri === '/openapi.json') {
    header('Content-Type: application/json');
    echo file_get_contents(__DIR__ . '/../openapi.json');
} 
else {
    notFound();
}

function notFound(): void {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}