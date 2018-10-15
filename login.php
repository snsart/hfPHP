<?php
require_once('connectvars.php');
if(!isset($_SERVER['PHP_AUTH_USER'])||!isset($_SERVER['PHP_AUTH_PW'])){
	header('HTTP/1.1401 Unauthorized');
	header('WWW-Authenticate:Basic realm="Mismatch"');
	exit('<h3>Mismatch</h3>sorry,you must enter your username and password');
}

$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_username=mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_USER']));
$user_password=mysqli_real_escape_string($dbc,trim($_SERVER['PHP_AUTH_PW']));

$query="select user_id,user_name from mismatch_user where username='$user_username' and password=SHA('$user_password')";
$data=mysqli_query($dbc,$query);

if(mysqli_num_rows($data)==1){
	$row=mysqli_fetch_array($data);
	$user_id=$row['user_id'];
	$username=$row['username'];
}else{
	header('HTTP/1.1401 Unauthorized');
	header('WWW-Authenticate:Basic realm="Mismatch"');
	exit('<h3>Mismatch</h3>sorry,you must enter your username and password');
}
echo('<p class="login">you are logged in as '.$username.'</p>');

?>