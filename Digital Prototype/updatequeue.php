	<?php 

            require('db.php');

              $sql = "SELECT * FROM Queue1 WHERE position_order > 1 ORDER BY position_order ASC ";
              $users = $connect->query($sql);
      while ($user = $users->fetch_assoc()) {
      	echo "<tr  id='";
      	echo $user['id'];
      	echo "'>";
      	echo "<td id='author' style='background-color:";
      	echo $user['color'];
      	echo ";'>";
      	echo $user['authorship'];
      	echo "</td>";
      	echo "<td>";
      	echo $user['title'];
      	echo "</td>";
      	echo "<td>";
      	echo $user['artist'];
      	echo "</td></tr>";
      	echo "<br>";



      	 } 
        
      ?>
