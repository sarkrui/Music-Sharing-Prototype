<?php 

include_once 'db.php';
    $name = "";
    $color = "#AAAA99";
    
    mysqli_query($connect,'DELETE FROM `Queue1`');
    mysqli_query($connect,'DELETE FROM `CurrentAuthor` LIMIT 1');
    mysqli_query($connect, "INSERT INTO `CurrentAuthor` (`name`, `color`) VALUES ('".$name."','".$color."')");
    header('Location: index.php');

?>

