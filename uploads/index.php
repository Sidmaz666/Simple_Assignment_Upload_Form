<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Uploads</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
a {
text-decoration:none;
font-weight:bold;
font-size:20px;
color:#000000;
}
.main{
padding:1%;
margin:1%;
}
.link{
padding:1.5%;
border:2px solid black;
border-top:0px;
cursor:pointer;
}
</style>
</head>
<body>
<center>
<br/>
<h2> All Students Assignment Uploads 📁 </h2>
<hr color="black" style='height:5px; border-radius:80%'/>
<div class="main">
<?php
$path = __DIR__;
if ($fh = opendir($path)) {
  while (($fname = readdir($fh)) !== false) {
    if ($fname!="." && $fname!=".." && $fname!="index.php") {
    // stckoverflow in action :)
      $frname= substr($fname, 0, strrpos($fname, '.'));
      $links =  "<a href='$fname'><span class=link>🗎 $frname</span></a><br>";
      echo $links."<br/><br/>";
    }
  }
  closedir($fh);
}

?>
</div>
  </center>
</body>
</html>
