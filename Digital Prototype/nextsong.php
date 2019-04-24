<?php 

include_once 'db.php';

    
    mysqli_query($connect,'DELETE FROM `Queue1` WHERE position_order = 1');
    header('Location: index.php');
    header("Refresh:0");

    $results = mysqli_query($connect,'SELECT `id`, `position_order` FROM `Queue1` ORDER BY position_order ASC');
    $i = 1;

    while ($song = mysqli_fetch_array($results)) {
      $sql = "Update Queue1 SET position_order=".($i++)." WHERE id=".$song['id'];
      $connect->query($sql);

    } 
?>

