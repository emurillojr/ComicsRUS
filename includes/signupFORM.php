<?php
// Ernesto Murillo Final Assignment - sign up form for sign up page
?> 
<div class="container">
    <div class="col-sm-6">
        <form method="post" action="SignUpPage.php">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="text" name="email" value = "" class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value = "" class="form-control">
            </div>
            <input class="btn btn-info" type="submit" name="submit" value="Sign up">

        </form>
    </div>
