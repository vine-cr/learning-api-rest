<?php

require_once __DIR__ . '/services.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/../config/config.php';
function handleGet(string $dataFile): void {
    try {
        echo respond(getAllUsers($dataFile));
    } catch(\Throwable $e) {
        http_response_code(500);
        echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
    }
}

function handlePost($dataFile): void {
    try{
        echo "teste";
        $input = json_decode(
            file_get_contents('php://input'), true
        );
        respond(createUser($dataFile, $input));
    } catch(\Throwable $e){
        http_response_code(500);
        echo json_encode([
            'error' => 'Internal Server Error',
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }
}

function handlePut(string $dataFile): void {
    try {
        $input = json_decode(
            file_get_contents('php://input'), true
        );
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        respond(editUser($dataFile, $id, $input));
    } catch (\throwable $e){
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error']);
    }
}

function respond(array $result): ?string{
    http_response_code($result['status']);

    if(isset($result['error'])) {
        return json_encode(['error' => $result['error']]);
    } else {
        return json_encode($result['users']);
    }
}