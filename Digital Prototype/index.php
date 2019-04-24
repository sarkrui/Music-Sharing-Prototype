
<!-- SOURCE: http://www.kodingmadesimple.com/2016/01/php-login-and-registration-script-with-mysql-example.html -->

<?php

// $myArr = array("John", "Mary", "Peter", "Sally");

// $myJSON = json_encode($myArr);

// echo $myJSON;

// session_start();
$page = $_SERVER['PHP_SELF'];
// $sec = "10";

include_once 'db.php';
//set validation error flag as false
// $error = false;

$sql = "SELECT * FROM Queue1 ORDER BY position_order ASC ";
$query = mysqli_query($connect, $sql);
$num_rows = mysqli_num_rows($query);
$myfile = fopen("/var/www/html/queue.txt", "w") or die("Unable to open file!"); 
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

<!-- from here the HTML (in other means, the content) starts. -->

<!DOCTYPE html>
<html>

<head> <!-- These are standard settings which probably will not be changed anymore --> 
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="URL='<?php echo $page?>'">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Music sharing</title> <!-- Tab title -->

  <link rel="stylesheet" href="style.css"> <!-- reference to style.css (layout) document  -->
  <link rel="icon" href="#"> <!-- Tab icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.0.min.js"></script> <!-- Reference to a software library -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!--   <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
  <script src="jquery.ui.touch-punch.min.js"></script> -->
<!--   <script type="text/javascript">
paused = false;
// set minutes
var mins = 1;
// calculate the seconds 
var secs = mins * 60;
var t=0;
  var flagTimer='resume';
function countdown() {

  t = setTimeout('Decrement()',1000);
  

}
function Decrement() {
  if (document.getElementById) {
    minutes = document.getElementById("minutes");
    seconds = document.getElementById("seconds");

  


    // if less than a minute remaining
    if (seconds < 59) {
      seconds.value = secs;
    } else {
      minutes.value = getminutes();
      seconds.value = getseconds();
    }
    secs--;
    
    t= setTimeout('Decrement()',1000);
  }
}
function getminutes() {
  // minutes is seconds divided by 60, rounded down
  mins = Math.floor(secs / 60);
  return mins;
}
function getseconds() {
  // take mins remaining (as seconds) away from total seconds remaining
  return secs-Math.round(mins *60);
}
function pause() { 
  if( flagTimer=='resume')
  {
    clearTimeout(t);
    t=0;
  document.getElementById('Pause').value="Resume";
    flagTimer='pause';
  }
  
}
function resume() {
  t= setTimeout('Decrement()',1000);
}

</script> -->
  <script >
   
     var image_tracker = 'orange';

   function change(){
   
   var image = document.getElementById('playbutton');
   var image1 = document.getElementById('pausebutton');
   if(image_tracker=='orange'){
   image.src='pausebutton.png';
   image_tracker='blue';
   
   document.getElementById('playbutton').id = 'pausebutton';
   playAudio();
   // resume();
  
   } 
   // else {
   //  pause();
   // }
   if (image_tracker=='blue'){
   image1.src='playbutton.png';
   image_tracker='orange';
   
   document.getElementById('pausebutton').id = 'playbutton';
   pauseAudio();
   // pause();

   } 
   // else {
   //  resume();
   // }

   }

   function change2(){
   var image = document.getElementById('playbutton');
   if(image_tracker=='orange'){
   image.src='pausebutton.png';
   image_tracker='blue';
   }
   else{
   image.src='playbutton.png';
   image_tracker='orange';
  
   }
   }



  </script>
  <script type="text/javascript">
    function togglequeue() {
   var queue = document.getElementById("queue"); 
   var recsongs = document.getElementById("recsongs");
   var addbutton = document.getElementById("rankbutton");
   var queuebutton = document.getElementById("queuebutton");

   queue.style.display = (
       queue.style.display == "none" ? "block" : "none"); 
   queuebutton.style.display = (
       queuebutton.style.display == "none" ? "block" : "none"); 

   recsongs.style.display = (
       recsongs.style.display == "none" ? "block" : "none"); 
    addbutton.style.display = (
       addbutton.style.display == "none" ? "block" : "none"); 
}
  </script>
  <!-- <script>
    $(function() {
$(".submit").click(function() {
var name = $("#name").val();
var color = $("#color").val();

var dataString = 'name='+ name + '&color=' + color;


$.ajax({
type: "POST",
url: "currentauthor.php",
data: dataString,
success: function(){
 alert("success!");
}
})


});
});


    </script> -->

<script type="text/javascript">
  function currentauthor1()
  {

  var authorname= $( "#authorname1" ).val();
   var color= $( "#color1" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor2()
  {

  var authorname= $( "#authorname2" ).val();
   var color= $( "#color2" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor3()
  {

  var authorname= $( "#authorname3" ).val();
   var color= $( "#color3" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor4()
  {

  var authorname= $( "#authorname4" ).val();
   var color= $( "#color4" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor5()
  {

  var authorname= $( "#authorname5" ).val();
   var color= $( "#color5" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor6()
  {

  var authorname= $( "#authorname6" ).val();
   var color= $( "#color6" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor7()
  {

  var authorname= $( "#authorname7" ).val();
   var color= $( "#color7" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor8()
  {

  var authorname= $( "#authorname8" ).val();
   var color= $( "#color8" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor9()
  {

  var authorname= $( "#authorname9" ).val();
   var color= $( "#color9" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor10()
  {

  var authorname= $( "#authorname10" ).val();
   var color= $( "#color10" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor11()
  {

  var authorname= $( "#authorname11" ).val();
   var color= $( "#color11" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor12()
  {

  var authorname= $( "#authorname12" ).val();
   var color= $( "#color12" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor13()
  {

  var authorname= $( "#authorname13" ).val();
   var color= $( "#color13" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor14()
  {

  var authorname= $( "#authorname14" ).val();
   var color= $( "#color14" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor15()
  {

  var authorname= $( "#authorname15" ).val();
   var color= $( "#color15" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor16()
  {

  var authorname= $( "#authorname16" ).val();
   var color= $( "#color16" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor17()
  {

  var authorname= $( "#authorname17" ).val();
   var color= $( "#color17" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor18()
  {

  var authorname= $( "#authorname18" ).val();
   var color= $( "#color18" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor19()
  {

  var authorname= $( "#authorname19" ).val();
   var color= $( "#color19" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor20()
  {

  var authorname= $( "#authorname20" ).val();
   var color= $( "#color20" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor21()
  {

  var authorname= $( "#authorname21" ).val();
   var color= $( "#color21" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor22()
  {

  var authorname= $( "#authorname22" ).val();
   var color= $( "#color22" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor23()
  {

  var authorname= $( "#authorname23" ).val();
   var color= $( "#color23" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor24()
  {

  var authorname= $( "#authorname24" ).val();
   var color= $( "#color24" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

    function currentauthor25()
  {

  var authorname= $( "#authorname25" ).val();
   var color= $( "#color25" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor26()
  {

  var authorname= $( "#authorname26" ).val();
   var color= $( "#color26" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor27()
  {

  var authorname= $( "#authorname27" ).val();
   var color= $( "#color27" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor28()
  {

  var authorname= $( "#authorname28" ).val();
   var color= $( "#color28" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor29()
  {

  var authorname= $( "#authorname29" ).val();
   var color= $( "#color29" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor30()
  {

  var authorname= $( "#authorname30" ).val();
   var color= $( "#color30" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor31()
  {

  var authorname= $( "#authorname31" ).val();
   var color= $( "#color31" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor32()
  {

  var authorname= $( "#authorname32" ).val();
   var color= $( "#color32" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor33()
  {

  var authorname= $( "#authorname33" ).val();
   var color= $( "#color33" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor34()
  {

  var authorname= $( "#authorname34" ).val();
   var color= $( "#color34" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor35()
  {

  var authorname= $( "#authorname35" ).val();
   var color= $( "#color35" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor36()
  {

  var authorname= $( "#authorname36" ).val();
   var color= $( "#color36" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor37()
  {

  var authorname= $( "#authorname37" ).val();
   var color= $( "#color37" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor38()
  {

  var authorname= $( "#authorname38" ).val();
   var color= $( "#color38" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor39()
  {

  var authorname= $( "#authorname39" ).val();
   var color= $( "#color39" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor40()
  {

  var authorname= $( "#authorname40" ).val();
   var color= $( "#color40" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor41()
  {

  var authorname= $( "#authorname41" ).val();
   var color= $( "#color41" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor42()
  {

  var authorname= $( "#authorname42" ).val();
   var color= $( "#color42" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor43()
  {

  var authorname= $( "#authorname43" ).val();
   var color= $( "#color43" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor44()
  {

  var authorname= $( "#authorname44" ).val();
   var color= $( "#color44" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor45()
  {

  var authorname= $( "#authorname45" ).val();
   var color= $( "#color45" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor46()
  {

  var authorname= $( "#authorname46" ).val();
   var color= $( "#color46" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor47()
  {

  var authorname= $( "#authorname47" ).val();
   var color= $( "#color47" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor48()
  {

  var authorname= $( "#authorname48" ).val();
   var color= $( "#color48" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor49()
  {

  var authorname= $( "#authorname49" ).val();
   var color= $( "#color49" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }

  function currentauthor50()
  {

  var authorname= $( "#authorname50" ).val();
   var color= $( "#color50" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'currentauthor.php',
    data: {
     author_name:authorname,
     color:color
    },
      success: function (response) {
     alert("Successfully selected the author!");
    }
   });
    
   return false;
  }
</script>
<script type="text/javascript">
  function submitdata1()
  {

    var idsong= $( "#id_song1" ).val();
   var titlesong=$( "#title_song1" ).val();
   var artistsong=$( "#artist_song1" ).val();
   var mp3song =$( "#mp3_song1" ).val();

   // var idsong= $_POST['id_song'];
   // var titlesong=$_POST['title_song'];
   // var artistsong=$_POST['artist_song'];
   // var mp3song =$_POST['mp3_song'];

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }
  function submitdata2()
  {

    var idsong= $( "#id_song2" ).val();
   var titlesong=$( "#title_song2" ).val();
   var artistsong=$( "#artist_song2" ).val();
   var mp3song =$( "#mp3_song2" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata3()
  {

    var idsong= $( "#id_song3" ).val();
   var titlesong=$( "#title_song3" ).val();
   var artistsong=$( "#artist_song3" ).val();
   var mp3song =$( "#mp3_song3" ).val();


   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata4()
  {

    var idsong= $( "#id_song4" ).val();
   var titlesong=$( "#title_song4" ).val();
   var artistsong=$( "#artist_song4" ).val();
   var mp3song =$( "#mp3_song4" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }

   });


    
   return false;
  }

  function submitdata5()
  {

    var idsong= $( "#id_song5" ).val();
   var titlesong=$( "#title_song5" ).val();
   var artistsong=$( "#artist_song5" ).val();
   var mp3song =$( "#mp3_song5" ).val();


   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata6()
  {

    var idsong= $( "#id_song6" ).val();
   var titlesong=$( "#title_song6" ).val();
   var artistsong=$( "#artist_song6" ).val();
   var mp3song =$( "#mp3_song6" ).val();


   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata7()
  {

    var idsong= $( "#id_song7" ).val();
   var titlesong=$( "#title_song7" ).val();
   var artistsong=$( "#artist_song7" ).val();
   var mp3song =$( "#mp3_song7" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata8()
  {

    var idsong= $( "#id_song8" ).val();
   var titlesong=$( "#title_song8" ).val();
   var artistsong=$( "#artist_song8" ).val();
   var mp3song =$( "#mp3_song8" ).val();


   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata9()
  {

    var idsong= $( "#id_song9" ).val();
   var titlesong=$( "#title_song9" ).val();
   var artistsong=$( "#artist_song9" ).val();
   var mp3song =$( "#mp3_song9" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata10()
  {

    var idsong= $( "#id_song10" ).val();
   var titlesong=$( "#title_song10" ).val();
   var artistsong=$( "#artist_song10" ).val();
   var mp3song =$( "#mp3_song10" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata11()
  {

    var idsong= $( "#id_song11" ).val();
   var titlesong=$( "#title_song11" ).val();
   var artistsong=$( "#artist_song11" ).val();
   var mp3song =$( "#mp3_song11" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata12()
  {

    var idsong= $( "#id_song12" ).val();
   var titlesong=$( "#title_song12" ).val();
   var artistsong=$( "#artist_song12" ).val();
   var mp3song =$( "#mp3_song12" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata13()
  {

    var idsong= $( "#id_song13" ).val();
   var titlesong=$( "#title_song13" ).val();
   var artistsong=$( "#artist_song13" ).val();
   var mp3song =$( "#mp3_song13" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata14()
  {

    var idsong= $( "#id_song14" ).val();
   var titlesong=$( "#title_song14" ).val();
   var artistsong=$( "#artist_song14" ).val();
   var mp3song =$( "#mp3_song14" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata15()
  {

    var idsong= $( "#id_song15" ).val();
   var titlesong=$( "#title_song15" ).val();
   var artistsong=$( "#artist_song15" ).val();
   var mp3song =$( "#mp3_song15" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata16()
  {

    var idsong= $( "#id_song16" ).val();
   var titlesong=$( "#title_song16" ).val();
   var artistsong=$( "#artist_song16" ).val();
   var mp3song =$( "#mp3_song16" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata17()
  {

    var idsong= $( "#id_song17" ).val();
   var titlesong=$( "#title_song17" ).val();
   var artistsong=$( "#artist_song17" ).val();
   var mp3song =$( "#mp3_song17" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata18()
  {

    var idsong= $( "#id_song18" ).val();
   var titlesong=$( "#title_song18" ).val();
   var artistsong=$( "#artist_song18" ).val();
   var mp3song =$( "#mp3_song18" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata19()
  {

    var idsong= $( "#id_song19" ).val();
   var titlesong=$( "#title_song19" ).val();
   var artistsong=$( "#artist_song19" ).val();
   var mp3song =$( "#mp3_song19" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata20()
  {

    var idsong= $( "#id_song20" ).val();
   var titlesong=$( "#title_song20" ).val();
   var artistsong=$( "#artist_song20" ).val();
   var mp3song =$( "#mp3_song20" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata21()
  {

    var idsong= $( "#id_song21" ).val();
   var titlesong=$( "#title_song21" ).val();
   var artistsong=$( "#artist_song21" ).val();
   var mp3song =$( "#mp3_song21" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata22()
  {

    var idsong= $( "#id_song22" ).val();
   var titlesong=$( "#title_song22" ).val();
   var artistsong=$( "#artist_song22" ).val();
   var mp3song =$( "#mp3_song22" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata23()
  {

    var idsong= $( "#id_song23" ).val();
   var titlesong=$( "#title_song23" ).val();
   var artistsong=$( "#artist_song23" ).val();
   var mp3song =$( "#mp3_song23" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata24()
  {

    var idsong= $( "#id_song24" ).val();
   var titlesong=$( "#title_song24" ).val();
   var artistsong=$( "#artist_song24" ).val();
   var mp3song =$( "#mp3_song24" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata25()
  {

    var idsong= $( "#id_song25" ).val();
   var titlesong=$( "#title_song25" ).val();
   var artistsong=$( "#artist_song25" ).val();
   var mp3song =$( "#mp3_song25" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata26()
  {

    var idsong= $( "#id_song26" ).val();
   var titlesong=$( "#title_song26" ).val();
   var artistsong=$( "#artist_song26" ).val();
   var mp3song =$( "#mp3_song26" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata27()
  {

    var idsong= $( "#id_song27" ).val();
   var titlesong=$( "#title_song27" ).val();
   var artistsong=$( "#artist_song27" ).val();
   var mp3song =$( "#mp3_song27" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata28()
  {

    var idsong= $( "#id_song28" ).val();
   var titlesong=$( "#title_song28" ).val();
   var artistsong=$( "#artist_song28" ).val();
   var mp3song =$( "#mp3_song28" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata29()
  {

    var idsong= $( "#id_song29" ).val();
   var titlesong=$( "#title_song29" ).val();
   var artistsong=$( "#artist_song29" ).val();
   var mp3song =$( "#mp3_song29" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata30()
  {

    var idsong= $( "#id_song30" ).val();
   var titlesong=$( "#title_song30" ).val();
   var artistsong=$( "#artist_song30" ).val();
   var mp3song =$( "#mp3_song30" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata31()
  {

    var idsong= $( "#id_song31" ).val();
   var titlesong=$( "#title_song31" ).val();
   var artistsong=$( "#artist_song31" ).val();
   var mp3song =$( "#mp3_song31" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata32()
  {

    var idsong= $( "#id_song32" ).val();
   var titlesong=$( "#title_song32" ).val();
   var artistsong=$( "#artist_song32" ).val();
   var mp3song =$( "#mp3_song32" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata33()
  {

    var idsong= $( "#id_song33" ).val();
   var titlesong=$( "#title_song33" ).val();
   var artistsong=$( "#artist_song33" ).val();
   var mp3song =$( "#mp3_song33" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata34()
  {

    var idsong= $( "#id_song34" ).val();
   var titlesong=$( "#title_song34" ).val();
   var artistsong=$( "#artist_song34" ).val();
   var mp3song =$( "#mp3_song34" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata35()
  {

    var idsong= $( "#id_song35" ).val();
   var titlesong=$( "#title_song35" ).val();
   var artistsong=$( "#artist_song35" ).val();
   var mp3song =$( "#mp3_song35" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata36()
  {

    var idsong= $( "#id_song36" ).val();
   var titlesong=$( "#title_song36" ).val();
   var artistsong=$( "#artist_song36" ).val();
   var mp3song =$( "#mp3_song36" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata37()
  {

    var idsong= $( "#id_song37" ).val();
   var titlesong=$( "#title_song37" ).val();
   var artistsong=$( "#artist_song37" ).val();
   var mp3song =$( "#mp3_song37" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata38()
  {

    var idsong= $( "#id_song38" ).val();
   var titlesong=$( "#title_song38" ).val();
   var artistsong=$( "#artist_song38" ).val();
   var mp3song =$( "#mp3_song38" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata39()
  {

    var idsong= $( "#id_song39" ).val();
   var titlesong=$( "#title_song39" ).val();
   var artistsong=$( "#artist_song39" ).val();
   var mp3song =$( "#mp3_song39" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata40()
  {

    var idsong= $( "#id_song40" ).val();
   var titlesong=$( "#title_song40" ).val();
   var artistsong=$( "#artist_song40" ).val();
   var mp3song =$( "#mp3_song40" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata41()
  {

    var idsong= $( "#id_song41" ).val();
   var titlesong=$( "#title_song41" ).val();
   var artistsong=$( "#artist_song41" ).val();
   var mp3song =$( "#mp3_song41" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata42()
  {

    var idsong= $( "#id_song42" ).val();
   var titlesong=$( "#title_song42" ).val();
   var artistsong=$( "#artist_song42" ).val();
   var mp3song =$( "#mp3_song42" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata43()
  {

    var idsong= $( "#id_song43" ).val();
   var titlesong=$( "#title_song43" ).val();
   var artistsong=$( "#artist_song43" ).val();
   var mp3song =$( "#mp3_song43" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata44()
  {

    var idsong= $( "#id_song44" ).val();
   var titlesong=$( "#title_song44" ).val();
   var artistsong=$( "#artist_song44" ).val();
   var mp3song =$( "#mp3_song44" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata45()
  {

    var idsong= $( "#id_song45" ).val();
   var titlesong=$( "#title_song45" ).val();
   var artistsong=$( "#artist_song45" ).val();
   var mp3song =$( "#mp3_song45" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata46()
  {

    var idsong= $( "#id_song46" ).val();
   var titlesong=$( "#title_song46" ).val();
   var artistsong=$( "#artist_song46" ).val();
   var mp3song =$( "#mp3_song46" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata47()
  {

    var idsong= $( "#id_song47" ).val();
   var titlesong=$( "#title_song47" ).val();
   var artistsong=$( "#artist_song47" ).val();
   var mp3song =$( "#mp3_song47" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata48()
  {

    var idsong= $( "#id_song48" ).val();
   var titlesong=$( "#title_song48" ).val();
   var artistsong=$( "#artist_song48" ).val();
   var mp3song =$( "#mp3_song48" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata49()
  {

    var idsong= $( "#id_song49" ).val();
   var titlesong=$( "#title_song49" ).val();
   var artistsong=$( "#artist_song49" ).val();
   var mp3song =$( "#mp3_song49" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata50()
  {

    var idsong= $( "#id_song50" ).val();
   var titlesong=$( "#title_song50" ).val();
   var artistsong=$( "#artist_song50" ).val();
   var mp3song =$( "#mp3_song50" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata51()
  {

    var idsong= $( "#id_song51" ).val();
   var titlesong=$( "#title_song51" ).val();
   var artistsong=$( "#artist_song51" ).val();
   var mp3song =$( "#mp3_song51" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata52()
  {

    var idsong= $( "#id_song52" ).val();
   var titlesong=$( "#title_song52" ).val();
   var artistsong=$( "#artist_song52" ).val();
   var mp3song =$( "#mp3_song52" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata53()
  {

    var idsong= $( "#id_song53" ).val();
   var titlesong=$( "#title_song53" ).val();
   var artistsong=$( "#artist_song53" ).val();
   var mp3song =$( "#mp3_song53" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata54()
  {

    var idsong= $( "#id_song54" ).val();
   var titlesong=$( "#title_song54" ).val();
   var artistsong=$( "#artist_song54" ).val();
   var mp3song =$( "#mp3_song54" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata55()
  {

    var idsong= $( "#id_song55" ).val();
   var titlesong=$( "#title_song55" ).val();
   var artistsong=$( "#artist_song55" ).val();
   var mp3song =$( "#mp3_song55" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata56()
  {

    var idsong= $( "#id_song56" ).val();
   var titlesong=$( "#title_song56" ).val();
   var artistsong=$( "#artist_song56" ).val();
   var mp3song =$( "#mp3_song56" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata57()
  {

    var idsong= $( "#id_song57" ).val();
   var titlesong=$( "#title_song57" ).val();
   var artistsong=$( "#artist_song57" ).val();
   var mp3song =$( "#mp3_song57" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata58()
  {

    var idsong= $( "#id_song58" ).val();
   var titlesong=$( "#title_song58" ).val();
   var artistsong=$( "#artist_song58" ).val();
   var mp3song =$( "#mp3_song58" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata59()
  {

    var idsong= $( "#id_song59" ).val();
   var titlesong=$( "#title_song59" ).val();
   var artistsong=$( "#artist_song59" ).val();
   var mp3song =$( "#mp3_song59" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata60()
  {

    var idsong= $( "#id_song60" ).val();
   var titlesong=$( "#title_song60" ).val();
   var artistsong=$( "#artist_song60" ).val();
   var mp3song =$( "#mp3_song60" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata61()
  {

    var idsong= $( "#id_song61" ).val();
   var titlesong=$( "#title_song61" ).val();
   var artistsong=$( "#artist_song61" ).val();
   var mp3song =$( "#mp3_song61" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata62()
  {

    var idsong= $( "#id_song62" ).val();
   var titlesong=$( "#title_song62" ).val();
   var artistsong=$( "#artist_song62" ).val();
   var mp3song =$( "#mp3_song62" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata63()
  {

    var idsong= $( "#id_song63" ).val();
   var titlesong=$( "#title_song63" ).val();
   var artistsong=$( "#artist_song63" ).val();
   var mp3song =$( "#mp3_song63" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata64()
  {

    var idsong= $( "#id_song64" ).val();
   var titlesong=$( "#title_song64" ).val();
   var artistsong=$( "#artist_song64" ).val();
   var mp3song =$( "#mp3_song64" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata65()
  {

    var idsong= $( "#id_song65" ).val();
   var titlesong=$( "#title_song65" ).val();
   var artistsong=$( "#artist_song65" ).val();
   var mp3song =$( "#mp3_song65" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata66()
  {

    var idsong= $( "#id_song66" ).val();
   var titlesong=$( "#title_song66" ).val();
   var artistsong=$( "#artist_song66" ).val();
   var mp3song =$( "#mp3_song66" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata67()
  {

    var idsong= $( "#id_song67" ).val();
   var titlesong=$( "#title_song67" ).val();
   var artistsong=$( "#artist_song67" ).val();
   var mp3song =$( "#mp3_song67" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata68()
  {

    var idsong= $( "#id_song68" ).val();
   var titlesong=$( "#title_song68" ).val();
   var artistsong=$( "#artist_song68" ).val();
   var mp3song =$( "#mp3_song68" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata69()
  {

    var idsong= $( "#id_song69" ).val();
   var titlesong=$( "#title_song69" ).val();
   var artistsong=$( "#artist_song69" ).val();
   var mp3song =$( "#mp3_song69" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata70()
  {

    var idsong= $( "#id_song70" ).val();
   var titlesong=$( "#title_song70" ).val();
   var artistsong=$( "#artist_song70" ).val();
   var mp3song =$( "#mp3_song70" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata71()
  {

    var idsong= $( "#id_song71" ).val();
   var titlesong=$( "#title_song71" ).val();
   var artistsong=$( "#artist_song71" ).val();
   var mp3song =$( "#mp3_song71" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata72()
  {

    var idsong= $( "#id_song72" ).val();
   var titlesong=$( "#title_song72" ).val();
   var artistsong=$( "#artist_song72" ).val();
   var mp3song =$( "#mp3_song72" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata73()
  {

    var idsong= $( "#id_song73" ).val();
   var titlesong=$( "#title_song73" ).val();
   var artistsong=$( "#artist_song73" ).val();
   var mp3song =$( "#mp3_song73" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata74()
  {

    var idsong= $( "#id_song74" ).val();
   var titlesong=$( "#title_song74" ).val();
   var artistsong=$( "#artist_song74" ).val();
   var mp3song =$( "#mp3_song74" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata75()
  {

    var idsong= $( "#id_song75" ).val();
   var titlesong=$( "#title_song75" ).val();
   var artistsong=$( "#artist_song75" ).val();
   var mp3song =$( "#mp3_song75" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata76()
  {

    var idsong= $( "#id_song76" ).val();
   var titlesong=$( "#title_song76" ).val();
   var artistsong=$( "#artist_song76" ).val();
   var mp3song =$( "#mp3_song76" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata77()
  {

    var idsong= $( "#id_song77" ).val();
   var titlesong=$( "#title_song77" ).val();
   var artistsong=$( "#artist_song77" ).val();
   var mp3song =$( "#mp3_song77" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata78()
  {

    var idsong= $( "#id_song78" ).val();
   var titlesong=$( "#title_song78" ).val();
   var artistsong=$( "#artist_song78" ).val();
   var mp3song =$( "#mp3_song78" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata79()
  {

    var idsong= $( "#id_song79" ).val();
   var titlesong=$( "#title_song79" ).val();
   var artistsong=$( "#artist_song79" ).val();
   var mp3song =$( "#mp3_song79" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata80()
  {

    var idsong= $( "#id_song80" ).val();
   var titlesong=$( "#title_song80" ).val();
   var artistsong=$( "#artist_song80" ).val();
   var mp3song =$( "#mp3_song80" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata81()
  {

    var idsong= $( "#id_song81" ).val();
   var titlesong=$( "#title_song81" ).val();
   var artistsong=$( "#artist_song81" ).val();
   var mp3song =$( "#mp3_song81" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata82()
  {

    var idsong= $( "#id_song82" ).val();
   var titlesong=$( "#title_song82" ).val();
   var artistsong=$( "#artist_song82" ).val();
   var mp3song =$( "#mp3_song82" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata83()
  {

    var idsong= $( "#id_song83" ).val();
   var titlesong=$( "#title_song83" ).val();
   var artistsong=$( "#artist_song83" ).val();
   var mp3song =$( "#mp3_song83" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata84()
  {

    var idsong= $( "#id_song84" ).val();
   var titlesong=$( "#title_song84" ).val();
   var artistsong=$( "#artist_song84" ).val();
   var mp3song =$( "#mp3_song84" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata85()
  {

    var idsong= $( "#id_song85" ).val();
   var titlesong=$( "#title_song85" ).val();
   var artistsong=$( "#artist_song85" ).val();
   var mp3song =$( "#mp3_song85" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata86()
  {

    var idsong= $( "#id_song86" ).val();
   var titlesong=$( "#title_song86" ).val();
   var artistsong=$( "#artist_song86" ).val();
   var mp3song =$( "#mp3_song86" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata87()
  {

    var idsong= $( "#id_song87" ).val();
   var titlesong=$( "#title_song87" ).val();
   var artistsong=$( "#artist_song87" ).val();
   var mp3song =$( "#mp3_song87" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata88()
  {

    var idsong= $( "#id_song88" ).val();
   var titlesong=$( "#title_song88" ).val();
   var artistsong=$( "#artist_song88" ).val();
   var mp3song =$( "#mp3_song88" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata89()
  {

    var idsong= $( "#id_song89" ).val();
   var titlesong=$( "#title_song89" ).val();
   var artistsong=$( "#artist_song89" ).val();
   var mp3song =$( "#mp3_song89" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }

  function submitdata90()
  {

    var idsong= $( "#id_song90" ).val();
   var titlesong=$( "#title_song90" ).val();
   var artistsong=$( "#artist_song90" ).val();
   var mp3song =$( "#mp3_song90" ).val();

   $.ajax({
    type: 'post',
    url: 'addfact.php',
    data: {
     song_id:idsong,
     song_title:titlesong,
     song_artist:artistsong,
     song_mp3:mp3song
    },
      success: function (response) {
     alert("Successfully added the song!");
    }
   });
    
   return false;
  }
  </script>
</head>


<body>


<!-- Navigation bar in the top -->
<div id="navbar" >
  <ul>
    <li><a href="index.php"><img id="logo" src="logo.svg"></a></li>
    <li><div id="rankbutton" onclick="togglequeue()"><?php  echo 'add songs'?></div><div id="queuebutton" style="display:none;" onclick="togglequeue()"><?php  echo 'queue'?></div></li> <!-- This one only appears, when specific calculations are saved and has an eventlistener to a function elaborated on in the bottom-->
     <li class="dropdown"><a href="javascript:void(0)"id="currentauthor" class="dropbtn">
       <?php 
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
     </a>
      <div class="dropdown-content" id="allauthors"><?php 
      $var2 = "SELECT `id`,`name`, `color` FROM `Authors1` ";
      $query = mysqli_query($connect, $var2);

      if(mysqli_num_rows($query) > 0)

          while ($row = mysqli_fetch_assoc($query)) {
            echo "<form method='POST' onsubmit='return currentauthor";
            echo $row['id'];
            echo "();'><div id='idsquares2' style='background-color: ";
            echo $row['color'];
            echo "'>";
            
            echo "<input id='authorname";
            echo $row['id'];
            echo "' type='hidden' name='name' value='";
            echo $row['name'];
            echo "'>";
            echo "<input id='color";
            echo $row['id'];
            echo "' type='hidden' name='color' value='";
            echo $row['color'];
            echo "'>";
            echo "<input id='selectauthor' type='submit' value='";
            echo $row['name'];
            echo "' name='submit_form' class='submit' >";
            echo "</div></form>"; 
        }

        ?></div>
    </li>
    <li><a href="addauthor.php"><div id="idsquares"><?php  echo '+'?></div></a></li>
  </ul>
</div>


<div id="queue">
<h1 style="margin-top: 50px;">Queue</h1>
    
<table class="table table-bordered">
  <tbody class="row_position">
            <?php 

            require('db.php');

              $sql = "SELECT * FROM Queue1 ORDER BY position_order ASC LIMIT 1 ";
              $users = $connect->query($sql);
      while ($user = $users->fetch_assoc()) {
        
      ?>

      <tr  id="<?php echo $user['id'] ?>">
                    <td id='author' <?php echo "style='background-color: "; echo $user['color']; echo "';"; ?>><?php echo $user['authorship'] ?></td>
                    <td><?php echo $user['title'] ?></td>
                    <td><?php echo $user['artist'] ?></td>
      </tr>

      <?php } ?>
    </tbody>
</table>

<table class="table table-bordered">
  <tbody class="row_position" id="slippylist">
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
       



         } 
        
      ?>     
    </tbody>
</table>
</div>




<div id="recsongs" style="display: none;">
<h1 style="margin-top: 50px;">Recommended songs</h1>

<?php 
  $var2 = "SELECT `songid`, `title`, `artist`, `mp3` FROM `Songs2` ORDER BY title ASC";

  $query = mysqli_query($connect, $var2);
  
  //In this if-statement the saved calculations of the current session will be displayed. Whenever an user refreshed the page, it will always display every saved calculations, even when removed (can be a point of improvement)
  if(mysqli_num_rows($query) > 0)

      while ($row = mysqli_fetch_assoc($query)) {
        echo "<form method='POST' onsubmit='return submitdata";
        echo $row['songid'];
        echo "();'>";
        echo "<div id='songs'>";
        echo "<input id= 'id_song";
        echo $row['songid'];
        echo "' type='hidden' name='id_song' value='";
        echo $row['songid'];
        echo "'readonly>";
        echo "<input id='title_song";
        echo $row['songid'];
        echo "' type='text' name='title_song' value='";
        echo $row['title'];
        echo "'readonly>";
        echo " - ";
        echo "<input id='artist_song";
        echo $row['songid'];
        echo "' type='text' name='artist_song' value='";
        echo $row['artist'];
        echo "' readonly>";
        echo "<input id='mp3_song";
        echo $row['songid'];
        echo "' type='hidden' name='mp3_song' value='";
        echo $row['mp3'];
        echo "'>";
        echo "<button type='submit' class='addbutton' name='submit_form' id='addsong'>
              <i class='fas fa-plus-square'></i>
              </button>";
        echo "</div>";
        echo "</form>";
        echo "<br/>";
        


    }



?> 
</div>

<!-- <div id="timer">
      <input id="minutes"  style="width: 24px; border: none; background-color:none;">mts
      <input id="seconds"  style="width: 26px; border: none; background-color:none;"/>second
        <div id="timer">
            <input type="button" id="Pause" value="Pause" onClick="pause();" />
        </div>
    </div>

<script type="text/javascript">
  countdown();
</script> -->

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
  <a href="nextsong.php" onclick="playAudio();"><img id="next" src="next.png"></a>

</div>
<a href="admin.php" id="admin">admin</a>

<script>
var x = document.getElementById("myAudio"); 

function playAudio() { 
    x.play(); 
} 

function pauseAudio() { 
    x.pause(); 
} 

myAudio.addEventListener("ended", function(){
     myAudio.currentTime = 0;
     window.location = 'nextsong.php';
});

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

 <script src='slip-master/slip.js'></script>
  <script type='text/javascript'>
    var list = document.getElementById('slippylist');
    new Slip(list);

    list.addEventListener('slip:reorder', function(e) {
    e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);

    var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
           

    $.ajax({
            url:"ajaxPro.php",
            type:'post',
            data:{position:selectedData}
            
        });

  })
  </script>


<!-- <script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("songid"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
      alert("hey");
        $.ajax({
            url:"ajaxPro.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script> -->

<script type="text/javascript">

    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"ajaxPro.php",
            type:'post',
            data:{position:data}
        })
    }
</script>

<script>
var timer = setInterval(listLoad, 3000);
// <!-- Every 1s this function is called... -->
function listLoad(){
    $(function(){
       $("#slippylist").load("updatequeue.php");
       
    });
}

var timer2 = setInterval(listLoad2, 3000);
// <!-- Every 1s this function is called... -->
function listLoad2(){
    $(function(){
       $("#currentauthor").load("updateauthor.php");
       
    });
}

</script>

</div>
<!-- this is a crucial ending tag of the php code. DO NOT MOVE -->


</body>
</html>
