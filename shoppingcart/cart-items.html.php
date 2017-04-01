<?php
// Ernesto Murillo Final Assignment - cart items 
?> 

<h1>Your Shopping Cart</h1>
<?php if (count($cart) > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>
                    <strong>Total:</strong>
                </td>
                <td>
                    <strong>$<?php echo number_format($total, 2); ?></strong>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($cart as $row): ?>
                <tr>
                    <td>
                        <?php echo $row['product']; ?>
                    </td>
                    <td>
                        <?php echo '$' . number_format($row['price'], 2); ?>
                    </td>
                    <td>
                        <img src="../uploads/<?php echo $row['image']; ?>" width="100px" />
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <p>Your cart is empty!</p>
<?php endif; ?>