<?php
// Ernesto Murillo Final Assignment - CRUD product create Page
?>
<html>

    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start();  // sessions started
        include './includes/loggedinOrDie.php'; //if not logged in DIE session
        include './includes/headBS.php';  //head and bootstrap  
        include './includes/headerForEachPage.php';  //header
        include './functions/functions.php'; // all functions
        include './functions/dbconnect.php'; // database connection function
        include './functions/until.php';  // isPost function
        include './functions/upload-function.php';  //upload pic function

        $db = dbconnect();   //connection database function
        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category ASC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = ''; //variables needed
        $results = ''; //variables needed
        $errors = array();  // errors array
        $category_id = filter_input(INPUT_POST, 'category_id'); //post to 
        $product = filter_input(INPUT_POST, 'product'); //post to 
        $price = filter_input(INPUT_POST, 'price'); //post to 
        $image = filter_input(INPUT_POST, 'image'); //post to 
        //verify if post has been made and if so ...check for errors below
        if (isPostRequest()) {
            // error check to see if product is blank
            if (empty($product)) {
                $errors[] = ' Invalid:  Product - Cannot be blank entry';
            }
            if (empty($price)) {
                $errors[] = ' Invalid:  Price - Cannot be blank entry';
            }
            try {
                if (count($_FILES) > 0) {
                    $image = uploadImage('upfile');
                }
            } catch (RuntimeException $e) {
                echo $e->getMessage();
            }
            if (empty($image)) {
                $errors[] = ' Invalid:  Image - Cannot be blank file';
            }
            if (count($errors) == 0) {
                $stmt = $db->prepare("INSERT INTO products SET category_id = :category_id, product = :product, price = :price, image = :image");
                $binds = array
                    (
                    ":category_id" => $category_id,
                    ":product" => $product,
                    ":price" => $price,
                    ":image" => $image
                );
                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $results = '****Product Added';
                }
            }
        }
        ?>

        <?php if (isset($errors) && is_array($errors)) : ?>
            <ul>           
                <?php foreach ($errors as $error): ?>            
                    <li><?php echo $error; ?></li>            
                <?php endforeach; ?>        
            </ul>
        <?php endif; ?>

        <a href="productVIEW.php">View Products</a> &nbsp; &nbsp;
        <a href="AdminFULLRIGHTS.php.php">Admin Home</a>&nbsp; &nbsp;
        <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>

    <?php
    include './includes/createPRODUCTform.php';
    echo $results;
    ?> 

</body>
</html>


