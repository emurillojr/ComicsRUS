<?php
// Ernesto Murillo Final Assignment - CRUD product view by category Page
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

        $db = dbconnect();  //connection database function
        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category ASC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = '';

        if (isPostRequest()) {
            $stmt = $db->prepare("SELECT * FROM products WHERE category_id = :category_id");
            $category_id = filter_input(INPUT_POST, 'category_id');
            $binds = array
                (
                ":category_id" => $category_id,
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $error = 'No Products found';
            }
        }
        ?>
        <p><a href="productCREATE.php">Add a new Product</a> &nbsp; &nbsp; 
            <a href="AdminFULLRIGHTS.php">Admin Home</a>&nbsp; &nbsp;
            <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>
        <br>
        <h2>View Products</h2>

        <?php if (isset($error)): ?>        
            <h1><?php echo $error; ?></h1>
        <?php endif; ?>


        <form method="post" action="#">

            <select class="form-control" name="category_id">
                <?php foreach ($categories as $row): ?>
                    <option 
                        value="<?php echo $row['category_id']; ?>"
                        <?php if (intval($category_id) === $row['category_id']) : ?>
                            selected="selected"
                        <?php endif; ?>
                        >
                            <?php echo $row['category']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
        <br>

        <?php if (isset($results)): ?>
            <h2>Results found <?php echo count($results); ?></h2>

            <table class="table table-striped" style="width:50%">
                <thead>
                    <tr>
                        <th>Product Name: </th>
                        <th>Price: </th>
                        <th>Image: </th>
                    </tr>
                </thead>

                <?php foreach ($results as $row): ?> 
                    <tr>
                        <td><?php echo $row['product']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td> <img src="../FINALLAB-em-3/uploads/<?php echo $row['image']; ?>" width="100px" /></td>
                        <td><a class="btn btn-success" href="productUPDATE.php?product_id=<?php echo $row['product_id']; ?>">Update</a></td>            
                        <td><a class="btn btn-danger" href="productDELETE.php?product_id=<?php echo $row['product_id']; ?>">Delete</a></td>            
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?> 
    </body>
</html>