<html>

    <?php
    // Ernesto Murillo Final Assignment - Sign up Page 

    session_start(); //session started
    include './includes/headBS.php';  //head and bootstrap  
    include './includes/headerForEachPage.php';  //header
    include './includes/links1.php';  //links
    include './includes/welcomeforSIGNUP.php';  // welcome message  & title
    include './functions/functions.php'; // all functions
    include './functions/dbconnect.php';  // database connection function
    include './functions/until.php'; // isPost function
    ?>
    <body>
        <?php
        $db = dbconnect();  //database connection function   
        $errors = array();  // errors array
        $email = filter_input(INPUT_POST, 'email'); //variables needed
        $password = filter_input(INPUT_POST, 'password'); //variables needed
        //verify if post has been made and if so ...check for errors below
        if (isPostRequest()) {
            // error check to see if email is blank
            if (empty($email)) {
                $errors[] = ' Invalid:  Email cannot be blank entry';
            }
            // error if filter var email fails
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors[] = ' Invalid Email: not correct format';
            }
            // error check to see if password is blank
            if (empty($password)) {
                $errors[] = ' Invalid:  Password cannot be blank entry';
            }
            //error if password is too short / less than 5 characters;
            if (strlen($password) < 5) {
                $errors[] = ' Password cannot be less than 5 characters';
            }
            //function
            checkDBifEmailSame(); // check if email already exists

            if (count($errors) == 0) {
                //function
                insertINTOdbUSERS();  //function to insert new into database
            }
        }
        ?>

        <?php if (isset($errors) && is_array($errors)) : //if and foreach for errors and array errors to echo them out
            ?>
            <ul>           
                <?php foreach ($errors as $error): ?>            
                    <li><?php echo $error; ?></li>            
                <?php endforeach; ?>        
            </ul>
        <?php endif; ?>

        <?php include './includes/signupFORM.php'; ?>

    </body>
</html>
