<?php

require 'UserAuthentication.php';

$username = $_POST['username'];
$password = $_POST['password'];
if (strlen($username) > 0 and strlen($password)){
    $result = login($username, $password);

    if ($result){
        header('Location: http://localhost/Prodeo/server/tempHome.html');
        exit();
    } else {
        echo 'Incorrect Credentials';
    }
} else {
    echo 'Please provide all the fields';
}


?>