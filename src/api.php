<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/controllers.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    handleGet($dataFile);
} elseif ($method === 'POST') {
    handlePost($dataFile);
} elseif ($method === 'PUT') {
    handlePut($dataFile);
} elseif ($method === 'PATCH') {
    handlePatch($dataFile);
} elseif ($method === 'DELETE') {
    handleDelete($dataFile);
} else {
    handleMethodNotAllowed();
}
