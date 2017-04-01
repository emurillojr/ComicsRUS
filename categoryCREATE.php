<?php
// Ernesto Murillo Final Assignment - CRUD category create Page
?> 
<html>

    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start(); //session started
        include './includes/loggedinOrDie.php'; //verify if logged in
        include './includes/headBS.php';  //head and bootstrap  
        include './includes/headerForEachPage.php';  //header
        include './functions/functions.php'; // all functions
        include './functions/dbconnect.php'; // database connection function
        include './functions/until.php';  // isPost function
        $results = ''; //variables needed
        $errors = array();  //variables needed
        $category = filter_input(INPUT_POST, 'category'); //variables needed
        $db = dbconnect();  //database connection function 
        if (isPostRequest($category)) {  //verify if post has been made 
            if (empty($category)) {   //verify if post is blank
                $errors[] = ' Invalid:  Category - Cannot be blank entry';
            }
            $stmt = $db->prepare("SELECT category FROM categories WHERE category = :category");
            $binds = array(
                ":category" => $category
            );
            //if post matches database - error  
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $errors[] = ' Error:  Category is already in the database';
            }

            if (count($errors) == 0) {
                // if no errors,  insert category
                $stmt = $db->prepare("INSERT INTO categories SET category = :category");
                $binds = array
                    (
                    ":category" => $category,
                );
                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $results = '**Cateogory Added**';
                }
            }
        }
        ?>
        <h3><?php echo $results; ?></h3>
        <?php if (isset($errors) && is_array($errors)) : ?>
            <ul>           
                <?php foreach ($errors as $error): ?>            
                    <li><?php echo $error; ?></li>            
                <?php endforeach; ?>        
            </ul>
        <?php endif; ?>

        <p><a href="categoryVIEW.php">View Categories</a> &nbsp; &nbsp; 
            <a href="AdminFULLRIGHTS.php">Admin Home</a>&nbsp; &nbsp;
            <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>

        <h2>Add a new Category</h2>
        <form method="post" action="#">            
            <a class="btn btn-warning">Category Name: </a><br> <input type="text" value="" name="category" size="40"/>
            <br />
            <br />
            <input type="submit" value="Submit" />
        </form>
        <br />

    </body>
</html>


