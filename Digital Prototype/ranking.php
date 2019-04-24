<!-- READ THIS
In the below document the flow advisor is developed. Notice that changes must be executed with modesty. 
Many things are not needed to be changed. In the php code backend (background/database) interactions are coded.
In the html code forend (forground/client side) interactions are coded. Please address these languages as two seperates.

Definition list:
<div> = a group
id = a unique mark to apply layout to which can be addressed with a # sign in style.css
class = a general mark to apply layout to which can be addressed with a . sign in style.css
<tr> = a row in a table
<td> = a column in a table
<script> usually all magic happens here

 -->

<!-- SOURCE: http://www.kodingmadesimple.com/2016/01/php-login-and-registration-script-with-mysql-example.html -->

<?php
// session_start();

// $page = $_SERVER['PHP_SELF'];
// $sec = "10";

include_once 'db.php';
//set validation error flag as false
$error = false;

?>

<!-- from here the HTML (in other means, the content) starts. -->

<!DOCTYPE html>
<html>

<head> <!-- These are standard settings which probably will not be changed anymore --> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"> -->

  <title>Music sharing</title> <!-- Tab title -->

  <link rel="stylesheet" href="style.css"> <!-- reference to style.css (layout) document  -->
  <link rel="icon" href="#"> <!-- Tab icon -->
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.0.min.js"></script> <!-- Reference to a software library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script >
     var image_tracker = 'orange';

   function change(){
   var image = document.getElementById('playbutton');
   if(image_tracker=='orange'){
   image.src='pausebutton.png';
   image_tracker='blue';
   playAudio()
   }
   else{
   image.src='playbutton.png';
   image_tracker='orange';
   pauseAudio()
   
   }
   }

      function change2(){
   var image = document.getElementById('playbutton');
   if(image_tracker=='orange'){
   image.src='playbutton.png';
   image_tracker='blue';
   }
   else{
   image.src='playbutton.png';
   image_tracker='orange';
  
   }
   }

  </script>
</head>


<body>


<!-- Navigation bar in the top -->
<div id="navbar" >
  <ul>
    <li><a href="index.php"><img id="logo" src="Logo white.png"></a></li>
    <li><a href="index.php" ><div id="rankbutton" onclick=""><?php  echo 'queue'?></div></a></li> <!-- This one only appears, when specific calculations are saved and has an eventlistener to a function elaborated on in the bottom-->
    <li class="dropdown"><a href="javascript:void(0)" class="dropbtn"><?php 
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

        ?></a>
      <div class="dropdown-content" id="allauthors"><?php 
      $var2 = "SELECT `name`, `color` FROM `Authors` ";
      $query = mysqli_query($connect, $var2);

      if(mysqli_num_rows($query) > 0)

          while ($row = mysqli_fetch_assoc($query)) {
            echo "<form method='post' action='currentauthor.php'><div id='idsquares2' style='background-color: ";
            echo $row['color'];
            echo "'>";
            echo "<input id='selectauthor' type='submit' value='";
            echo $row['name'];
            echo "' name='submit' readonly>";
            echo "<input id='authorname' onclick='selectAuthor()' type='hidden' name='name' value='";
            echo $row['name'];
            echo "'readonly>";
            echo "<input type='hidden' name='color' value='";
            echo $row['color'];
            echo "'readonly>";
            echo "</div></form>"; 
        }

        ?></div>
    </li>
    <li><a href="addauthor.php"><div id="idsquares"><?php  echo '+'?></div></a></li>

  </ul>
</div>


<h1 style="margin-top: 150px;">Recommended songs</h1>



<!-- Log out button will be visible all time --> 
<div id="footer">
  <?php
            require('db.php');

            $sql = "SELECT `mp3` FROM Queue1 ORDER BY position_order ASC LIMIT 1";
            $users = $connect->query($sql);
            while($user = $users->fetch_assoc()){


            ?>
                <audio id="myAudio" class="audio" preload="none">
                  <source src="songs/<?php echo $user['mp3'];?>" type="audio/mpeg">
                </audio>

  <?php }?>   
  <img id="previous" src="previous.png">
  <img id="playbutton" src="playbutton.png" alt="Circle" onclick="change();">
  <a href="nextsong.php"><img id="next" src="next.png"></a>
</div>

<script>
var x = document.getElementById("myAudio"); 

function playAudio() { 
    x.play(); 
} 

function pauseAudio() { 
    x.pause(); 
} 



</script>

<script>

// function setCookie(c_name,value,exdays)
// {
//     var exdate=new Date();
//     exdate.setDate(exdate.getDate() + exdays);
//     var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
//     document.cookie=c_name + "=" + c_value;
// }

// function getCookie(c_name)
// {
//     var i,x,y,ARRcookies=document.cookie.split(";");
//     for (i=0;i<ARRcookies.length;i++)
//     {
//       x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
//       y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
//       x=x.replace(/^\s+|\s+$/g,"");
//       if (x==c_name)
//         {
//         return unescape(y);
//         }
//       }
// }

// var song = document.getElementsByTagName('audio')[0];
// var played = false;
// var tillPlayed = getCookie('timePlayed');
// function update()
// {
//     if(!played){
//         if(tillPlayed){
//         song.currentTime = tillPlayed;
//         song.play();
//         played = true;
//         }
//         else {
//                 song.play();
//                 played = true;
//         }
//     }

//     else {
//     setCookie('timePlayed', song.currentTime);
    
//     }
// }
// setInterval(update,50);

</script>
<?php 
  $var2 = "SELECT `songid`, `title`, `artist`, `mp3` FROM `Songs` ";

  $query = mysqli_query($connect, $var2);
  
  //In this if-statement the saved calculations of the current session will be displayed. Whenever an user refreshed the page, it will always display every saved calculations, even when removed (can be a point of improvement)
  if(mysqli_num_rows($query) > 0)

      while ($row = mysqli_fetch_assoc($query)) {
        echo "<form method='post' action='addsong.php'>";
        echo "<div id='songs'>";
        echo "<input type='hidden' name='songid' value='";
        echo $row['songid'];
        echo "'readonly>";
        echo "<input type='text' name='title' value='";
        echo $row['title'];
        echo "'readonly>";
        echo " - ";
        echo "<input type='text' name='artist' value='";
        echo $row['artist'];
        echo "' readonly>";
        echo "<input type='hidden' name='mp3' value='";
        echo $row['mp3'];
        echo "'>";
        // echo "<input type='image' src='playbutton.png'>";
        echo "<input id='addsong' type='submit' value='+' name='submit'>";
        echo "</div>";
        echo "</form>";
        echo "<br/>";
        


    }



?> 

  
</div>



</div>

<script>
// Add active class to the current button (highlight it)
// var header = document.getElementById("allsongs");
// var idsquares = header.getElementsByClassName("idsquares");
// for (var i = 0; i < idsquares.length; i++) {
//   idsquares[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }

function myFunction() {
    var element = document.getElementById("idsquares");
    element.classList.toggle("active");
}

</script>
</div>

<!-- Whenever the user did not pass the login submission he/she will see the following content after the 'else' tag (the code in between the script tags will be used when interacting with this content) -->
 

</body>
</html>
