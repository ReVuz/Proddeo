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

?>