<?php

//  Ernesto Murillo checks if logged in if not die session 

session_start();
include './functions/isLoggedIn.php';
if (isLoggedIn()) {
    $errorloggedinalready = "You are already logged in. Please go to Shop, Admin, or you may log out.";
    echo $errorloggedinalready;
}
?>