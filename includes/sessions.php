<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        $hello = 'hello';
        $_SESSION['hello'] = 'hello';
        $_SESSION['cart'] = array();
        $_SESSION['cart']['product'] = 'mouse';
        $_SESSION['cart']['product1'] = 'mouse1';
        $_SESSION['cart']['product2'] = 'mouse2';
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = true;
        $_SESSION['email'] = true;
        ?>
    </body>
</html>
