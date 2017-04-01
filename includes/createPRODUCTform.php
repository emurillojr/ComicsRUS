<?php
//  Ernesto Murillo Final Assignment - create products form with category 
?>

<form method="post" action="#" enctype="multipart/form-data" >            
    <h1>Admin Create Product Page</h1>
    <h3>Add a new Product</h3>
    To add a new product, select a Category and fill in the Product information.
    <br>
    <br>
    <select class="form-control" name="category_id" >
        <?php foreach ($categories as $row): ?>
            <option 
                value="<?php echo $row['category_id']; ?>"
                >
                    <?php echo $row['category']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <a class="btn btn-default">Product: </a><br>
    <input type="text" value="" name="product" size="40"/><br>
    <br>

    <a class="btn btn-default">Price: </a> <br>
    <input type="float" value="" name="price" size="40"/><br>
    <br>

    <a class="btn btn-default">Add Image: </a> <br>
    <input type="file" value="" name="upfile" size="40"/><br>
    <br>
    <br>

    <input type="submit" value="Add Product" />
</form>
<br />