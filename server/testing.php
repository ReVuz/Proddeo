<?php
require 'login.php';

$result = login('kiran','1254');
var_dump($result);
if ($result){
    echo '<br>The user can login<br>';
} else { 
    echo '<br>The user cant login<br>';
}
?>