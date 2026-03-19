<?php

function getAllUsers(string $dataFile): array{
    $data = loadData($dataFile);
    return ['user' => $data['user']];
}

function createUser(string $input, array $dataFile): ?array{
    $error = validateRequiredFields($input, ['name', 'age', 'email']);

    if($error){
        return ['error' => $error, 'status' => 400] ;
    }

    $error = validateUserFields($input);

    if($error){
        return ['error' => $error, 'status' => 400];
    }

    $user = insertUser($dataFile, [
        'name'   => trim($input['name']),
        'age'    => (int) $input['age'],
        'email'  => $input['email'],
        ]
    );
    return ['data' => $user, 'status' => 201];
}