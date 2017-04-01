<?php
// Ernesto Murillo Final Assignment - CRUD update category Page
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

        $db = dbconnect();
        $result = '';  //variables needed
        $product = '';  //variables needed
        $image = '';  //variables needed

        $stmt = $db->prepare("SELECT * FROM categories ORDER BY category ASC");
        $categories = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $category_id = '';

        /* see fuctions.php for clarification on this function */
        if (isPostRequest()) {
            //$category_id = filter_input(INPUT_POST, 'category_id');
            $product_id = filter_input(INPUT_POST, 'product_id');
            $product = filter_input(INPUT_POST, 'product');
            $category_id = filter_input(INPUT_POST, 'category_id');
            $price = filter_input(INPUT_POST, 'price');
            $image = filter_input(INPUT_POST, 'image');

            $stmt = $db->prepare("UPDATE products SET product = :product, category_id = :category_id, price=:price, image=:image WHERE product_id = :product_id");

            try {
                if (count($_FILES) > 0) {
                    $image = uploadImage('upfile');
                }
            } catch (RuntimeException $e) {
                //echo $e->getMessage();
            }

            $binds = array
                (
                ":category_id" => $category_id,
                ":product_id" => $product_id,
                ":product" => $product,
                ":price" => $price,
                ":image" => $image
            );

            $message = '*****Update failed';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $message = '*****Update Complete';
            }
        } else {
            $product_id = filter_input(INPUT_GET, 'product_id');

            if (!isset($product_id)) {
                die('Product not found');
            }

            $stmt = $db->prepare("SELECT * FROM products where product_id = :product_id");
            $binds = array
                (
                ":product_id" => $product_id
            );
            $results = array();
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                $product = $results['product'];
                $price = $results['price'];
                $image = $results['image'];
            } else {
                die('Product ID not found');
            }
        }
        ?>

        <p><a href="productCREATE.php">Add a new Product</a> &nbsp; &nbsp; 
            <a href="productVIEW.php">View Products</a> &nbsp; &nbsp;
            <a href="AdminFULLRIGHTS.php">Admin Home</a>&nbsp; &nbsp;
            <a href="LogOutPage.php">Log Out</a>&nbsp; &nbsp;</p>

        <h2>Update Product</h2>
        <br />

        <form method="post" action="#" enctype="multipart/form-data"  > 
            <a class="btn btn-success">Current Cateogory: </a>
            <select class="form-control" name="category_id" >
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

            <a class="btn btn-success">Product Name: </a><br> <input type="text" value="<?php echo $product ?>" name="product" size="40"/><br>
            <br>
            <a class="btn btn-success">Price: </a><br> <input type="float" value="<?php echo $price ?>" name="price" size="40"/><br>
            <br>

            <td> <a class="btn btn-success">Current Image: </a> <br> 
                <img src="../FINALLAB-em-3/uploads/<?php echo $image; ?>" width="100px" /></td>
            <br><br> 
            <input type="file" value="" name="upfile" size="40"/><br>
            <br />
            <input type="hidden" value="<?php echo $product_id; ?>" name="product_id" /> 
            <input type="hidden" value="<?php echo $image; ?>" name="image" /> 
            <input type="submit" value="Update Product" />
        </form>
        <br />
        <br />

        <p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>

    </body>
</html>
