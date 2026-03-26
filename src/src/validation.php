<?php

function validateRequiredFields(array $input, array $fields): ?string{
    $missing = [];
    foreach($fields as $field){
        if(!isset($input[$field])){
            $missing[] = $field;
        }
    }
    return !empty($missing) ? implode(", ", $missing) . ' are required' : null;
}

function validateUserFields(array $input): ?string{
    $name = trim($input['name']);
    $email = $input['email'];
    $age = $input['age'];

    if(empty($name)){
        return "Nome não pode ser vazio. \n";
    } elseif(strlen($name) > 100){
        return "Nome muito longo. \n";
    } elseif(!preg_match("/^[a-zA-Z\s]+$/", $name)){
        return "Nome pode conter apenas letras e espaços. \n";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Email invalido. \n";
    }

    if(!is_numeric($age)){
        return "Idade precisa ser um numero. \n";
    } elseif($age < 0){
        return "Idade não pode ser vazio nem negativo. \n";
    }

    return null;
}
