<?php 

include_once 'db.php';

 
if (isset($_POST['song_id'])) {
  $id = $_POST['song_id'];
  $song = $_POST['song_title'];
  $artist = $_POST['song_artist'];
  $mp3 = $_POST['song_mp3'];

  // $id = $_POST['song_id'];
  // $song = $_POST['song_title'];
  // $artist = $_POST['song_artist'];
  // $mp3 = $_POST['song_mp3'];


  $var3 = "SELECT `name`, `color` FROM `CurrentAuthor` ";
  $var4 = "SELECT * FROM Queue1";

  $query = mysqli_query($connect, $var3);
  $query1 = mysqli_query($connect, $var4);
  $rownumber = mysqli_num_rows($query1) + 1;
  $row = mysqli_fetch_assoc($query); 


  //In this if-statement the saved calculations of the current session will be displayed. Whenever an user refreshed the page, it will always display every saved calculations, even when removed (can be a point of improvement)
  if(mysqli_num_rows($query) > 0)
    


    if(mysqli_query($connect, "INSERT INTO `Queue1` (`songid`,`title`,`artist`, `mp3`, `authorship`, `color`, `position_order`) VALUES ('".$id."','".$song."','".$artist."','".$mp3."','".$row['name']."','".$row['color']."', '".$rownumber."' ) " ) ) {

      echo "<script>alert('Successfully added!');</script>";

    }
    else {
      echo "DAMMNN ITT";
      echo "Failed to connect to MySQL: " . mysqli_error();
    }

 
}


$sql = "SELECT * FROM Queue1 ORDER BY position_order ASC ";
$query = mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($query);
$myfile = fopen("queue.txt", "w") or die("Unable to open file!"); 
$bracket1 = "{";
$bracket2 = "}";
fwrite($myfile, $bracket1);

  while($row = mysqli_fetch_array($query))
{   
    $txt = "position_";
    $arr = ($row['position_order']);
    $arr1 = ($row['color']);

    if ($row['position_order'] < $num_rows) {
    $jsondata .=  json_encode($txt . $arr) . ":" . json_encode($arr1) . ",\n";

    }
    else {
      $jsondata .=  json_encode($txt . $arr) . ":" . json_encode($arr1) . "\n";
    }
}

fwrite($myfile, $jsondata);
fwrite($myfile, $bracket2);
fclose($myfile);


?>

