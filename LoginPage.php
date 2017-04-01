<html>
    <?php
    //Ernesto Murillo Final Assignment - Log In Page

    session_start(); //session started
    include './includes/headBS.php';  //head and bootstrap  
    include './includes/headerForEachPage.php';  //header
    include './includes/links1.php';  //links
    include './includes/welcomeforLOGIN.php'; // welcome message & title
    include './functions/functions.php'; // all functions
    include './functions/dbconnect.php'; // database connection function
    include './functions/until.php';  // isPost function
    include './functions/isLoggedIn.php';  // is lgged in function
    ?>
    <body>
        <?php
        if (isLoggedIn()) {
            $errorlogout = "****** Note:  You are already logged in.";
            echo $errorlogout;
        } else {
            $db = dbconnect();  //database connection function   
            $email = filter_input(INPUT_POST, 'email'); //variables needed
            $password = filter_input(INPUT_POST, 'password');  //variables needed
            //verify if post has been made 
            if (isPostRequest()) {
                userDBcheckToLogin(); // check DB to match email password for login
            }
        }
        include './includes/loginFORM.php'; // log in form
        ?>
    </body>
</html>
