<?php

function loadData($dataFile)
{
    if (!file_exists($dataFile)) {
        return ['nextId' => 1, 'users' => []];
    }
    $data = json_decode(file_get_contents($dataFile), true);
    if (!$data) {
        $data = ['nextId' => 1, 'users' => []];
    }
    return $data;
}

function saveData($dataFile, $data)
{
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function findAllUsers($dataFile)
{
    return loadData($dataFile);
}

function insertUser($dataFile, $user)
{
    $data = loadData($dataFile);

    $id = 1;
    if (isset($data['nextId'])) {
        $id = $data['nextId'];
    }
    $data['nextId'] = $id + 1;

    $user['id'] = $id;
    $data['users'][] = $user;

    saveData($dataFile, $data);
    return $user;
}

function updateUser($dataFile, $id, $fields)
{
    $data = loadData($dataFile);

    foreach ($data['users'] as $index => $user) {
        if ($user['id'] === $id) {
            $data['users'][$index] = array_merge($user, $fields);
            saveData($dataFile, $data);
            return $data['users'][$index];
        }
    }

    return null;
}

function deleteUser($dataFile, $id)
{
    $data = loadData($dataFile);

    foreach ($data['users'] as $index => $user) {
        if ($user['id'] === $id) {
            array_splice($data['users'], $index, 1);
            saveData($dataFile, $data);
            return $user;
        }
    }

    return null;
}
