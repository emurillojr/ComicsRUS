<?php
// Ernesto Murillo Final Assignment - checkout 
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title>Shopping Cart Checkout</title>
    </head>
    <body>
        <?php
        include '../includes/headerForEachPage.php';  //includes
        include '../includes/links2.php';
        include '../functions/cart.php';
        session_start();

        /* php processing variables */
        $action = filter_input(INPUT_POST, 'action');

        if ($action === 'Empty cart') {
            emptyCart();
        }

        /* View variables */
        startCart();
        $cart = getCart();
        $total = getCartTotal();

        include './cart-items.html.php';
        include './clear-cart.html.php';
        ?>

        <p><a href="ShopPage.php">Continue Shopping</a></p>
    </body>
</html>
