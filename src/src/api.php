<?php

require_once __DIR__ . '/controllers.php';
require_once __DIR__ . '/../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];  

match($method){
    'GET'       => handleGet($dataFile),
    'POST'      => handlePost($dataFile),
    'PUT'       => handlePut($dataFile),
    'PATCH'     => handlePatch($dataFile),
    'DELETE'    => handleDelete($dataFile),
    default   => handleMethodNotFound(),
};

function handleMethodNotFound(): void{
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}