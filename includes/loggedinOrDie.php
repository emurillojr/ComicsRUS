<?php

// Ernesto Murillo Final Assignment - template logged in or die for all pages

include './functions/isLoggedIn.php';
if (!isLoggedIn()) {
    die('Invalid! You are not currently logged in.');
}
?>