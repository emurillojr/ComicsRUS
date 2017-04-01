<?php

// Ernesto Murillo  function by Session to verify if user is logged in or not.

function isLoggedIn() {

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
        return false;
    }
    return true;
}
