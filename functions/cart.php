<?php

// Ernesto Murillo Final Assignment - shopping cart function page

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

// seperate function to just show all 
//this works  displays all products on index
function getItems() {    // get all products
    include_once '../functions/dbconnect.php';
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM products");
    $PRODresults = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $PRODresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } return $PRODresults;
}

//this works displays all categories on index
function getCategories() {      // get all categories
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM categories");
    $CATresults = array(
    );
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $CATresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } return $CATresults;
}

// displays items(products) by category id for catalog page
function getItemsByCategory($id) {
    $items = getItems();
    $cart = [];
    foreach ($items as $product) {
        if ($product['category_id'] == $id) {     //'category' is suppose to be 'category_id'
            $cart[] = $product;
        }
    }
    return $cart;
}

function emptyCart() {
    unset($_SESSION['cart']);
}

function startCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

function getCart() {
    return $_SESSION['cart'];
}

function cartCount() {
    return count(getCart());
}

function addToCart($id) {
    $items = getItems();

    foreach ($items as $product) {
        if ($product['product_id'] == $id) {
            $_SESSION['cart'][] = $product;
            break;
        }
    }
}

function getCartTotal() {
    $items = getCart();
    $total = 0;
    foreach ($items as $product) {
        $total += $product['price'];
    }
    return $total;
}
