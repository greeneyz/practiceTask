<?php
$con = mysqli_connect('127.0.0.1','root','123','guestbook');

$target = "images/"; 
    if(!is_dir($target))
       mkdir($target);
$target = $target . basename( $_FILES['photo']['name']); 

//values from frontend
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$desc = $_POST['feedback'];

//information about photo
$fname=($_FILES['photo']['name']); 
$tmpName  = $_FILES['photo']['tmp_name'];
$fileSize = $_FILES['photo']['size'];
$fileType = $_FILES['photo']['type'];

$file="images/".$_FILES["photo"]["name"];

//process the file
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc()){
$fname = addslashes($fname);}

//throw error if db not connected
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 

//insert data
$data = "INSERT INTO feedback (fname, lname, feedback, date, filetype, filesize, path)
VALUES ('$firstname', '$lastname', '$desc', now(),'$fileType','$fileSize','$file')";

if (mysqli_query($con, $data)) 
{
    echo "feedback created";
} 
else
{
    echo "Error: " . $data . "<br>" . $con->error;
}

 //Writes the photo to the server 
 if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
 {  
    echo "The file ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
  else 
  {          
     echo "Sorry, there was a problem uploading your file."; 
  }
  $con->close();
     ?> 
    