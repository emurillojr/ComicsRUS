<?php
// Ernesto Murillo Final Assignment - CRUD category delete Page
?>
<html>

    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start();  // session started
        include './includes/loggedinOrDie.php';  //if not logged in DIE session
        include './includes/headBS.php';  //head and bootstrap 
        include './includes/headerForEachPage.php';  //header
        include './functions/dbconnect.php';  // database connection function

        $db = dbconnect(); //database connection function
        $category_id = filter_input(INPUT_GET, 'category_id');
        $stmt = $db->prepare("DELETE FROM categories where category_id = :category_id");
        $binds = array(
            ":category_id" => $category_id
        );

        $isDeleted = false;   // deleted verification
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }
        ?>

        <h1> Record 
            <?php if (!$isDeleted):  //message?>   
                Not
            <?php endif; ?>
            Deleted</h1>

        <p> <a href="categoryView.php">View Categories</a></p>

    </body>
</html>

