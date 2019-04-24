<?php 
require('db.php');
      $var2 = "SELECT `name`, `color` FROM `CurrentAuthor` ";
      $query = mysqli_query($connect, $var2);

      if(mysqli_num_rows($query) > 0)

          while ($row = mysqli_fetch_assoc($query)) {
            echo "<div id='idsquares2' style='background-color: ";
            echo $row['color'];
            echo "'>";
            echo "<input id='selectauthor' type='submit' value='";
            echo $row['name'];
            echo "' name='submit' readonly>";
            echo "</div>"; 
        }

        ?>