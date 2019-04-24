

<?php 


require('db.php');

$position = $_POST['position'];


$i=1;
foreach($position as $k=>$v){
    $sql = "Update Queue1 SET position_order=".$i." WHERE id=".$v;
    $connect->query($sql);

	$i++;
}
    
header("Refresh:0");

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

