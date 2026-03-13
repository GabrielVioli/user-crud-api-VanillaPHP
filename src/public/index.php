<?php

require_once __DIR__ . '/../config/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$uri = strtok($_SERVER['REQUEST_URI'], '?');
if ($uri === '/api/users') {
    require __DIR__ . '/../api.php';
} else {
    notFound();
}

function notFound()
{
    http_response_code(404);
    echo json_encode(['error' => 'Not found']);
}
