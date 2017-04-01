<?php

// Ernesto Murillo  function to check if a Post request has been made.

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}
