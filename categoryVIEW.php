<?php
// Ernesto Murillo Final Assignment - CRUD category view all Page
?>
<html>
    <title>ComicsRUS Admin CRUD Page</title>
    <body>
        <?php
        session_start(); // session started
        include './includes/loggedinOrDie.php'; //if not logged in DIE session
        include './includes/headBS.php';  //head and bootstrap  
        include './includes/headerForEachPage.php';  //header
        include './functions/dbconnect.php'; // database connection function

        $db = dbconnect();  //connection database function
        /* create a variable to hold the database SQL statement */
        $stmt = $db->prepare("SELECT * FROM categories");
        /* We execute the statement and make sure we got some results back */
        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <p><a href="categoryCREATE.php">Add a new Category</a> &nbsp; &nbsp; 
            <a href="AdminFULLRIGHTS.php">Admin Home</a>&nbsp; &nbsp;
            <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>
        <br>

        <h2>View Categories</h2>
        <table class="table table-striped">

            <thead>
                <tr>

                    <th>Category Name: </th>
                </tr>
            </thead>

            <?php foreach ($results as $row): ?> 
                <tr>
                    <td><?php echo $row['category']; ?></td>
                    <td><a class="btn btn-success" href="categoryUPDATE.php?category_id=<?php echo $row['category_id']; ?>">Update</a></td>            
                    <td><a class="btn btn-danger" href="categoryDELETE.php?category_id=<?php echo $row['category_id']; ?>">Delete</a></td>            
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
