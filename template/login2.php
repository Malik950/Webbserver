<?php
if(empty($_POST['username'])||empty($_POST['password'])){
	header("Location:login.php");
	
	require "../include/connect.php";
}


$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING_FILTER_FLAG_STRIP_LOW);

$sql="SELECT password, status FROM users WHERE username=?";
$res=$dbh->prepare($sql);
$res->bind_param("s",$username);
$_SESSION['username']=$username;
$_SESSION['status']=$row['status'];
$res->execute();
$result=$res->get_result();
$row=$result->fetch_assoc();
if(!row){
	header("Location:login.php?status=1");
}
else{
	if(password_verify($password,$row['password']){
		session_start();
		$_SESSION['username']=$username;
		header("Location:admin.php");
	}
}
if(!isset($_SESSION['username'])){
	echo<<<NAV
	
?>