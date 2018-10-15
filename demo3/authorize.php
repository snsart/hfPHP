<?php
$username="rock";
$password="roll";
if(!isset($_SERVER['PHP_AUTH_USER'])||!isset($_SERVER['PHP_AUTH_PW'])||$_SERVER['PHP_AUTH_USER']!=$username||$_SERVER['PHP_AUTH_PW']!=$password){
	header('http/1.1401 unauthorized');
	header('www-authenticate:basic realm="Guitar wars"');
	exit('<h2>Guitar Wars</h2>you must enter a valid user and password to access this page');
}
?>