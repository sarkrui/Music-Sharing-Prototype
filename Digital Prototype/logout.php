<!-- This is the logout script. Actually nothing needs to changed in here. The session of a user will be destroyed
over here and you will be redirected to the login part of the index page, which is only visible for users who did not pass the login form -->

<?php
session_start();

if(session_destroy())
{


header("Location: index.php");
}
?>

