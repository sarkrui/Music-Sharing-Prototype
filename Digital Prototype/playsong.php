<?php


            require('db.php');


            $sql = "SELECT `mp3` FROM Queue1 LIMIT 1";
            $users = $connect->query($sql);
            while($user = $users->fetch_assoc()){


            ?>
                <audio autoplay>
              <source src="songs/<?php echo $user['mp3'];?>" type="audio/mpeg">
                </audio>

<?php } echo "<script>window.location = 'index.php';</script>"; ?>