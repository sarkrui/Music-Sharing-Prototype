<?php 

include_once 'db.php';


 
if (isset($_POST['submit'])) {
  $id = mysqli_real_escape_string($connect, $_POST['songid']);
  $song = mysqli_real_escape_string($connect, $_POST['title']);
  $artist = mysqli_real_escape_string($connect, $_POST['artist']);
  $mp3 = mysqli_real_escape_string($connect, $_POST['mp3']);
  $var3 = "SELECT `name`, `color` FROM `CurrentAuthor` ";
  $var4 = "SELECT * FROM Queue1";


  $query = mysqli_query($connect, $var3);
  $query1 = mysqli_query($connect, $var4);
  $rownumber = mysqli_num_rows($query1) + 1;
  $row = mysqli_fetch_assoc($query); 


  //In this if-statement the saved calculations of the current session will be displayed. Whenever an user refreshed the page, it will always display every saved calculations, even when removed (can be a point of improvement)
  if(mysqli_num_rows($query) > 0)
    


    if(mysqli_query($connect, "INSERT INTO `Queue1` (`songid`,`title`,`artist`, `mp3`, `authorship`, `color`, `position_order`) VALUES ('".$id."','".$song."','".$artist."','".$mp3."','".$row['name']."','".$row['color']."', '".$rownumber."' ) " ) ) {
      
      echo "<script>alert('Successfully added!');window.location = 'ranking.php';</script>";

    }
    else {
      echo "DAMMNN ITT";
      echo "Failed to connect to MySQL: " . mysqli_error();
    }

 
}



?>

