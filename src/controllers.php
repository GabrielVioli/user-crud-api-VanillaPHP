<?php

require_once __DIR__ . '/services.php';

function respond($result)
{
    http_response_code($result['status']);
    if (isset($result['error'])) {
        echo json_encode(['error' => $result['error']]);
    } else {
        echo json_encode($result['data']);
    }
}

function handleGet($dataFile)
{
    echo json_encode(getAllUsers($dataFile));
}

function handlePost($dataFile)
{
    $input = json_decode(file_get_contents('php://input'), true);
    respond(createUser($dataFile, $input));
}

function handlePut($dataFile)
{
    $input = json_decode(file_get_contents('php://input'), true);
    $id = null;
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    respond(editUser($dataFile, $id, $input));
}

function handlePatch($dataFile)
{
    $input = json_decode(file_get_contents('php://input'), true);
    $id = null;
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    respond(editUser($dataFile, $id, $input, true));
}

function handleDelete($dataFile)
{
    $id = null;
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    respond(removeUser($dataFile, $id));
}

function handleMethodNotAllowed()
{
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
