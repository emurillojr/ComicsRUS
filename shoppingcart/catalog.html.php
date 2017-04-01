<?php
// Ernesto Murillo Final Assignment - catalog 
?> 

<h1>Catalog of Products</h1>
<table border ="1" width="25%">
    <thead>
        <tr>
            <th width="25%">Product</th>
            <th width="10%">Price</th>
            <th width="1%">Image</th>
            <th width="10%">Buy</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>  
            <tr>
                <td><?php echo $item['product']; ?></td>
                <td>
                    <?php echo '$' . number_format($item['price'], 2); ?>
                </td>
                <td> <img src="../uploads/<?php echo $item['image']; ?>" width="100px" /></td>
                <td>
                    <form action="" method="post">
                        <div>
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <input type="submit" name="action" value="Buy">
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
