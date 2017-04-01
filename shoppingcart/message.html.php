<?php
// Ernesto Murillo Final Assignment - if errors or message 
?> 


<?php if (isset($errors)) : ?>
    <ul>    
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>    
        <?php endforeach; ?> 
    </ul>
<?php endif; ?>

<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>