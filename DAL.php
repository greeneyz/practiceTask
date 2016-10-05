<?php
$con = mysqli_connect('127.0.0.1','root','123','guestbook');
if(!$con){
die("couldnt connect");
}
$query = "SELECT * FROM feedback";
$result = $con->query($query);
$r = array();
if( $result->num_rows>0){
while($row = $result->fetch_assoc()){
$r[] = $row;
}
}
$res = json_encode($r);
echo $res;
?>