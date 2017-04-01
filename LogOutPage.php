<?php

//Ernesto Murillo Final Assignment - Log out Page 

session_start();  //session started
include './includes/headBS.php';  //head and bootstrap  
include './includes/headerForEachPage.php';  //header
include './includes/links1.php';  //links
include './functions/isLoggedIn.php';  // is logged in function
// verification error if you click log out and you are not logged in
if (!isLoggedIn()) {
    $errorlogout = "Invalid! You are not currently logged in.";
    echo $errorlogout;
} else {
    unset($_SESSION['loggedin']);  //end log in session and display log out message
    unset($_SESSION['user_id']);  //end user id session

    $logout = 'You are now logged off.  
                      Thank you for visiting ComicsRUS.  
                      We hope to see you again soon.';
    echo $logout;
}
?>

