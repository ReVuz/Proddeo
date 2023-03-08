<?php

require 'UserAuthentication.php';

$username = $password = $email = '';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$rePassword = $_POST['re_password'];
if (strlen($username) == 0 or strlen($password) == 0 or strlen($email) == 0 or strlen($rePassword) == 0){
    echo 'Please provide all the fields';
} else if ($password != $rePassword){
    echo 'The given passwords do not match';
} else {
    $validityMessage = checkValidSignup($email, $username, $password);
    
    if ($validityMessage == 'Success'){
        $result = signup($email, $username, $password);
        echo 'Successfully signed up';
        header('Location: http://localhost/Prodeo/server/tempHome.html');
        exit();
    } else {
        echo $validityMessage;
    }

}
?>