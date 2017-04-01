<?php
// Ernesto Murillo Final Assignment - CRUD update category Page
?>
<html>

    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start(); // session started
        include './includes/loggedinOrDie.php'; //if not logged in DIE session
        include './includes/headBS.php';  //head and bootstrap  
        include './includes/headerForEachPage.php';  //header
        include './functions/functions.php'; // all functions
        include './functions/dbconnect.php'; // database connection function
        include './functions/until.php';  // isPost function

        $db = dbconnect();  //connection database function
        $result = '';  //variables needed
        $category = '';  //variables needed

        if (isPostRequest()) {
            $category_id = filter_input(INPUT_POST, 'category_id');
            $category = filter_input(INPUT_POST, 'category');
            $stmt = $db->prepare("UPDATE categories SET category = :category WHERE category_id = :category_id");
            $binds = array
                (
                ":category_id" => $category_id,
                ":category" => $category,
            );
            $message = 'Update failed';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $message = 'Update Complete';
            }
        } else {
            $category_id = filter_input(INPUT_GET, 'category_id');
            if (!isset($category_id)) {
                die('Record not found');
            }
            $stmt = $db->prepare("SELECT * FROM categories where category_id = :category_id");
            $binds = array
                (
                ":category_id" => $category_id
            );
            $results = array();
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                $category = $results['category'];
            } else {
                // header('Location:categoryVIEW.php');
                die('ID not found');
            }
        }
        ?>
        <p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <p> <a href="categoryCREATE.php">Add a new Category</a> &nbsp; &nbsp; 
            <a href="categoryVIEW.php">View Categories</a> &nbsp; &nbsp;
            <a href="AdminFULLRIGHTS.php">Admin Home</a>&nbsp; &nbsp;
            <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>

        <h2>Update Category</h2>
        <br />
        <br />
        <form method="post" action="#">            
            <a class="btn btn-success">Category Name: </a><br> <input type="text" value="<?php echo $category ?>" name="category" size="40"/>
            <br />
            <br />
            <br />
            <input type="hidden" value="<?php echo $category_id; ?>" name="category_id" /> 
            <input type="submit" value="Update" />
        </form>
        <br />
        <br />
    </body>
</html>
