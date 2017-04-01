<?php
// Ernesto Murillo Final Assignment - log in form for log in page 
?> 
<div class="container">
    <div class="col-sm-6">
        <form method="post" action="LoginPage.php">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="text" name="email" value = "" class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value = "" class="form-control">
            </div>
            <input class="btn btn-success" type="submit" name="submit" value="Log in">
        </form>
    </div>
