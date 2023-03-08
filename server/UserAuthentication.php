<?php

require 'vendor/autoload.php';

#   login() takes username and password returns true if it is registered and the password is correct else return false

function login($username, $password){


    $client = new MongoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->users;


    $result = $collection->count(
        ['Username' => $username , 'Password' => $password]
    );

    if ($result == 1){
        return true;
    }
}

#   checkValidPassword() checks for a valid password, returns true for valid password and false for invalid passwords.

function checkValidPassword($password){

    $hasNumber = preg_match('@[0-9]@', $password);
    $hasCapital = preg_match('@[A-Z]@', $password);
    $hasSpecial = preg_match('[@_!#$%^&*()<>?/|}{~:]', $password);
    $LongPassword = false;
    if (strlen($password) >= 8){
        $LongPassword = true;
    } else {
        $LongPassword = false;
    }


    if ($hasNumber and $hasCapital and $hasSpecial and $LongPassword){
        return true;
    } else {
        return false;
    }

}

#   checkValidEmail() function checks for valid email, rerturns 1 if valid, returns 0 for already registered email and returns -1 for invalid emails.

function checkValidEmail($email){

    $client = new MongoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->users;


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return -1 ;
    }


    $result = $collection->count(
        ['_id' => $email]
    );

    
    if ($result == 1 ){
        return 0;
    } else {
        return 1;
    }
}


#   checkValidUsername() checks for valid username. returns 1 for valid email, returns 0 for already registered username
#   and -1 for invalid username

function checkValidUsername($username){

    $client = new MongoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->users;


    if (strlen($username) <= 3 or strlen($username) > 30){
        return -1;
    }


    $result = $collection->count(
        [ 'Username' => $username]
    );

    if ($result == 1){
        return 0;
    } else {
        return 1;
    }
}


function checkValidSignup($email, $username, $password){
    $client = new MongoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->users;

    $isValidEmail = checkValidEmail($email);
    if ($isValidEmail == -1){
        return 'Please provide a valid email.';
    } else if ($isValidEmail == 0){
        return 'The given email is already registered.';
    }


    $isValidUsername = checkValidUsername($username);
    if ($isValidUsername == -1){
        return 'The username must be greater than 3 and lesser than 30 Characters long.';
    } else if ($isValidUsername == 0){
        return 'The given username is unvailable';
    }


    $isValidPassword = checkValidPassword($password);
    if ($isValidPassword){
        return 'The password must be 8 charaters long and contain a Number , a Capital letter and a special character';
    }


    return 'Success';
}


#   SignUP() checks for all the constraints for username, password and email. If anything is invalid returns a message telling what is wrong 
#   If everything is valid it outputs 1

function signup(string $email, string $username, string $password){
    
    $client = new MongoDB\Client;
    $database = $client->Prodeo;
    $collection = $database->users;

    $isValidEmail = checkValidEmail($email);
    if ($isValidEmail == -1){
        return false;
    } else if ($isValidEmail == 0){
        return false;
    }


    $isValidUsername = checkValidUsername($username);
    if ($isValidUsername == -1){
        return false;
    } else if ($isValidUsername == 0){
        return false;
    }


    $isValidPassword = checkValidPassword($password);
    if ($isValidPassword){
        return false;
    }


    $collection->insertOne(
        [
            '_id'       => $email,
            'Username'  => $username,
            'Password'  => $password,
            'Type'  => 'regular'
        ]
        );
    
    return true;
}

?>