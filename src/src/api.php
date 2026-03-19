<?php

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];  

match($method){
    'GET'       => handleGet($dataFile),
    'POST'      => handlePost($dataFIle),
    'PUT'       => handlePut($dataFile),
    'PATCH'     => handlePatch($dataFIle),
    'DELETE'    => handleDelete($dataFIle),
    default   => handleMethodNotFound(),
};

function handleMethodNotFound(): void{
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}