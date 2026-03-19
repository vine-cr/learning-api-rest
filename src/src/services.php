<?php

require_once __DIR__ . '/validation.php';
function getAllUsers(string $dataFile): array{
    $data = loadData($dataFile);
    return ['users' => $data['users'], 'status' => 200];
}

function createUser(string $dataFile, array $input): ?array{
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
    return ['users' => $user, 'status' => 201];
}

function editUser(string $dataFile, int $id, array $input): ?array{
    $error = validateRequiredFields($input, ['name', 'age', 'email']);
    
    if($error){
        return ['error' => $error, 'status' => 400] ;
    }

    $error = validateUserFields($input);

    if($error){
        return ['error' => $error, 'status' => 400];
    }
    
    $allowed = ['name', 'age', 'email'];
    $fields = array_intersect_key($input, array_flip($allowed));

    print_r($fields);
    if(isset($fields)){
        $fields['name'] = trim($fields['name']);
    }

    if(isset($fields)){
        $fields['age'] = (int)$fields['age'];
    }

    $user = updateUser($dataFile, $id, $fields);
    return $user === null
        ? ['error' => 'User not found', 'status' => 404]
        : ['users' => $user, 'status' => 200];
}