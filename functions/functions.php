<?php

// Ernesto Murillo Final Assignment - other functions page
// function to insert user into database -  email and password
function insertINTOdbUSERS() {
    $results = '';
    $db = dbconnect();
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $stmt = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = now()");
    $binds = array(
        ":email" => $email,
        ":password" => sha1($password)
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = 'User Accepted and Added.  You may log in now to shop!';
    }echo $results;
}

// function to check database if email exists already        
function checkDBifEmailSame() {
    $errors = "";
    $db = dbconnect();
    $email = filter_input(INPUT_POST, 'email');
    $stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
    $binds = array(
        ":email" => $email
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $errors = ' Error:  Email has already been used.  Please enter another email';
    }echo $errors;
}

// login function to check database if email & password are same        
function userDBcheckToLogin() {
    $db = dbconnect();
    $errors = "";
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email and password = :password");
    $binds = array(
        ":email" => $email,
        ":password" => sha1($password)
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $_SESSION['loggedin'] = true;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $user['user_id'];
        $results = '****You have now logged in.  You may proceed.';
        echo $results;
    } else {
        $errors = ' Error:  Log in failed. Please retry.';
        echo $errors;
    }
}
