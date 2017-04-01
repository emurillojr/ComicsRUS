<?php
// Ernesto Murillo Final Assignment - CRUD product delete Page
?>

<html>

    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start();  //sessions started
        include './includes/loggedinOrDie.php'; //if not logged in DIE session
        include './includes/headBS.php';  //head and bootstrap  
        include './includes/headerForEachPage.php';  //header
        include './functions/dbconnect.php'; // database connection function

        $db = dbconnect();  //connection database function
        $product_id = filter_input(INPUT_GET, 'product_id');  //get
        $stmt = $db->prepare("DELETE FROM products WHERE product_id = :product_id");
        $binds = array(
            ":product_id" => $product_id
        );

        $isDeleted = false;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }
        ?>

        <h1> Record 
            <?php if (!$isDeleted): ?> 
                Not
            <?php endif; ?>
            Deleted</h1>

        <p> <a href="productVIEW.php">View Products</a></p>

    </body>
</html>

