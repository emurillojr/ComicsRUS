<?php
// Ernesto Murillo Final Assignment - Shop page 
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>Shopping Cart</title>
    </head>
    <body>

        <?php
        session_start(); //sessions started
        include '../includes/headerForEachPage.php';  //includes
        include '../includes/headBS.php';
        include '../includes/links2.php';
        include '../includes/welcomeforSHOP.php';
        include '../functions/cart.php';


        /* php processing variables */
        $action = filter_input(INPUT_POST, 'action');
        $cartID = filter_input(INPUT_POST, 'product_id');  // change?
        $catID = filter_input(INPUT_GET, 'category_id'); //change?

        if ($action === 'Buy') {
            addToCart($cartID);
        }

        if ($action === 'Empty cart') {
            emptyCart();
        }

        /* View variables */
        startCart();
        $items = getItems();    // gets all products     $items is just a variable 
        $cartCount = cartCount();   //gets count of items
        $allCategories = getCategories();  // gets all categories    $allCategories is just a variable

        if (!is_null($catID)) {    // if category_id is not all  then  get products by category_id
            $items = getItemsByCategory($catID);
        }

        include './categories.html.php';
        include './cart-count.html.php';
        include './clear-cart.html.php';
        include './catalog.html.php';
        ?>

    </body>
</html>
