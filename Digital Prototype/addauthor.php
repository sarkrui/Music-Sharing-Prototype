

<?php 

include_once 'db.php';

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($connect, $_POST['name']);
  $color = mysqli_real_escape_string($connect, $_POST['color']);
    mysqli_query($connect,'DELETE FROM `CurrentAuthor` WHERE id = 1');

    if(mysqli_query($connect, "INSERT INTO `Authors1` (`name`, `color`) VALUES ('".$name."','".$color."')") && mysqli_query($connect, "INSERT INTO `CurrentAuthor` (`name`, `color`) VALUES ('".$name."','".$color."')")) {

      echo "<script>alert('Successfully added!');</script>";
      header('Location: index.php');
      header("Refresh:0");

    }
    else {
      echo "kutzoooi";
      echo "Failed to connect to MySQL: " . mysqli_error();
    }
}



?>


<!DOCTYPE html>
<html>

<head> <!-- These are standard settings which probably will not be changed anymore --> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Music sharing</title> <!-- Tab title -->

  <link rel="stylesheet" href="style.css"> <!-- reference to style.css (layout) document  -->
  <link rel="icon" href="#"> <!-- Tab icon -->
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.0.min.js"></script> <!-- Reference to a software library -->
  <script>
  
  function selectred() {

        var colorcode = document.getElementById('red').innerHTML;
        document.getElementById("color").value = colorcode;
      }

  function selectgreen() {
        var colorcode = document.getElementById('green').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectblue() {
        var colorcode = document.getElementById('blue').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectyellow() {
        var colorcode = document.getElementById('yellow').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectpink() {
        var colorcode = document.getElementById('pink').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectcyan() {
        var colorcode = document.getElementById('cyan').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectpurple() {
        var colorcode = document.getElementById('purple').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectlightgreen() {
        var colorcode = document.getElementById('lightgreen').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectorange() {
        var colorcode = document.getElementById('orange').innerHTML;
        document.getElementById("color").value = colorcode;
  }

  function selectgrey() {
        var colorcode = document.getElementById('grey').innerHTML;
        document.getElementById("color").value = colorcode;
  }
  </script>
</head>


<body>

<h1 id="addFact" style="margin-top: 150px;">Add author</h1>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table><tr><td>Name</td><td><input type="text" value="" name="name" placeholder="Three letters maximum" maxlength="3"></td></tr><tr id="colorinput"><td>Color</td><td> <input id="color" type="text" value="" Placeholder="Color or a HEX-code" name="color"></td></tr></table>
  <?php 
  $var2 = "SELECT `color`, `code` FROM `Colors` ";

  $query = mysqli_query($connect, $var2);
  
  //In this if-statement the saved calculations of the current session will be displayed. Whenever an user refreshed the page, it will always display every saved calculations, even when removed (can be a point of improvement)
  if(mysqli_num_rows($query) > 0)

      while ($row = mysqli_fetch_assoc($query)) {
        echo "<div id='";
        echo $row['color'];
        echo "' onclick='select";
        echo $row['color'];
        echo "();'style='background-color: ";
        echo $row['code'];
        echo ";' value=' ";
        echo $row['code'];
        echo "'>";
        echo $row['code'];
        echo "</div>";

    }

echo "<br/>";

?>
  <input class="button" type="submit" value="add" name="submit">
</form>



</body>

</html>
