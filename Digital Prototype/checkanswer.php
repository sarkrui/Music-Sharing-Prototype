<!-- This is the logout script. Actually nothing needs to changed in here. The session of a user will be destroyed
over here and you will be redirected to the login part of the index page, which is only visible for users who did not pass the login form -->

<?php
session_start();


//check if login form is submitted
if ($_POST['myanswer']=='Olivier') {
    
	header("Location: peop.php");
    $answer = mysqli_real_escape_string($connect, $_POST['']);
    $pass = mysqli_real_escape_string($connect, $_POST['pass']);
    $result = mysqli_query($connect, "SELECT * FROM users WHERE username = '" . $username. "' and password = '" . $pass . "'");

    //here it creates the session variables which can be consulted anywhere
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
      } else {
        $errormsg = "Incorrect username or password! Please try again.";
    }
}




?>

