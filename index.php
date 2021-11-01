<?php
$notifi = "";
if($_SERVER["REQUEST_METHOD"] == "POST" ){
  $stdname=trim($_POST['fullname']);
  $rollno=trim($_POST['roll']);
  $email=str_replace('.','-',$_POST['email']);
  $semester=trim($_POST['semester']);
  $subject=trim($_POST['subject']);
  $department=trim($_POST['department']);
  $rewritefn = strtolower(str_replace(' ','-',"$stdname-$rollno-$department-$subject $semester $email"));
  
  $filename =$_FILES['assignment']['name'];
  $filetype= $_FILES['assignment']['type'];
  $filesize =$_FILES['assignment']['size'];
  $fileerr = $_FILES['assignment']['error'];
  $filetmp = $_FILES['assignment']['tmp_name'];
  chmod($_FILES['assignment']['tmp_name'], 0664);
  // onigiri in .
 $ext = explode('.',$filename);
  //last piece of data from array
 $extension = strtolower(end($ext));
  $filesallowed = array('pdf','docx');
   if(in_array($extension,$filesallowed)){
     if ($fileerr === 0){
       if ($filesize < 5242880){
	 $ff = "$rewritefn.$extension";
	 $loc = "uploads/".$ff;
	   if(move_uploaded_file($filetmp,$loc))
	   {
	     // upload hoise ekhn view korar jonno banaite lagbo
	     $notifi="<span class=notifi>✔ Assignment Uploaded!</span><hr/><style>
	       button, input , select, option, h3{
			display:none;
		}
	       </style>";
	 } else {
echo $loc;
	 $notifi="<span class=notifi>✖️  Something Went Wrong Unable To upload the Assignment!</span><hr/>";
	 }
       
       } else {
	 
	 $notifi="<span class=notifi>⚠️  Your Assignment should be less than 5MB!</span><hr/>";
       }
     
     } else {
   $notifi="<span class=notifi>✖️  Corrupted File/Unable to Upload!</span><hr/>";
     }
   
   } else {
   $notifi="<span class=notifi>❌ Upload your Assignment as PDF!</span><hr/>";
   }
}
?>
<!--- simpl WRD --->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<link rel="shortcut icon" href="https://www.pinclipart.com/picdir/big/344-3445944_png-file-svg-terminal-icon-png-clipart.png">
  <title>Assignment Submission</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
body{
height:100%;
overflow:auto;
}
.notifi{
font-weight:bold;
padding:0px;
}
.notifi hr{
background:#000000;
height:2px;
}
.magic{
margin-top:0.5%;
max-height:90%;
max-width:90%;
border: 2px solid #000000;
}
.inpstylef{
border-bottom: 2px solid #000000;
padding:0.5%;
font-size:14px;
font-weight:bold;
}
.inputstyle ,.inpstyles {
width:69%;
height:35px;
border:2px solid #000000;
}
.inpstylef::-webkit-file-upload-button {
  visibility: hidden;
}
.inpstylef::before {
  content: '  ';
  display: inline-block;
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
::placeholder{
color:#151715;
opacity:1;
font-weight:bold;
}
.magic h3{
    text-align: left;
    padding-left: 260px;

}
</style>  
</head>
<body>
  <center>
    <div class="magic">
      <h1> Assignment Submission</h1>
	<hr style="width:inherit;padding:0px;height:2px; background:#000000"/>
	<span class="notifi"><?php echo "$notifi"; ?></span>
      <form action="" method="post" enctype="multipart/form-data">
        <h3>Full Name:</h3>
        <input class="inputstyle" type="text" name="fullname" placeholder=" Example:Monkey D Luffy" required>
        <h3>Roll Number:</h3>
        <input class="inputstyle" type="number" name="roll" placeholder=" Example: 30 " required>
        <h3>Email:</h3>
        <input class="inputstyle" type="email" name="email" placeholder=" Example: xxx123@xyz.abc" required>
        <h3>Semester:</h3>
        <select id="" style="background:#151715; color:#ffffff; font-weight:bold"  class="inpstyles" name="semester" required>
          <option class="inpstyl">1st-Semester</option>
          <option class="inpstyl">2nd-Semester</option>
          <option class="inpstyl">3rd-Semester</option>
	</select><br/>      
	  <h3>Subject</h3>
        <select id="" class="inpstyles" style="background:#151715; color:#ffffff; font-weight:bold" name="subject" required>
          <option value="math" class="inpstyl">Maths</option>
          <option value="perception" class="inpstyl">Perception</option>
          <option value="question" class="inpstyl">Questions</option>
          <option value="lies" class="inpstyl">Lies</option>
          <option value="egodilution" class="inpstyl">Ego Dilution</option>
          <option value="realization" class="inpstyl">Realization</option>
        </select><br/><br/>
	 <h3>Choose Your Department</h3>
        <select id="" class="inpstyles"style="background:#151715; color:#ffffff; font-weight:bold"  name="department" required>
          <option value="GR" class="inpstyl">General Relativity</option>
          <option value="ST" class="inpstyl">String Theory</option>
          <option value="PP" class="inpstyl">Philosopher</option>
        </select> 
        <br>
        <br><div style="display:flex; flex-direction:column;  align-items: center;justify-content: center;">
	 <h3 style="padding-left:50px" >Upload Assignment:</h3>
        <input id="" class="inpstylef" type="file" name="assignment"></div>
        <br>
        <br>
        <br>
        <button type="submit" style="margin-bottom:15px; color:#ffffff; background:#151715; width:50%; font-weight:bold ;height:35px" name="submit">Upload Assignment</button>
      </form>
    </div>
  </center>
  
</body>
</html>      
