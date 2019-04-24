<?php 

include_once 'db.php';
	
if (isset($_POST['author_name'])) {
	$author_name = mysqli_real_escape_string($connect, $_POST['author_name']);
  	$color = mysqli_real_escape_string($connect, $_POST['color']);
    
    if(mysqli_query($connect, "INSERT INTO `CurrentAuthor` (`name`, `color`) VALUES ('".$author_name."','".$color."')")) {

      echo "<script>alert('Successfully changed!');</script>";

    }
    else {
      echo "kutzoooi";
      echo "Failed to connect to MySQL: " . mysqli_error();
    }
    mysqli_query($connect,'DELETE FROM `CurrentAuthor` LIMIT 1');
}
    
 

?>