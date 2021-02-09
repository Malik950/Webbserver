<?php
require "../include/connect.php";
if(empty($_POST['username'])||empty($_POST['password'])){
	header("Location:login.php");
	
}


$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);

$sql="SELECT password, status FROM users WHERE username=?";
$res=$dbh->prepare($sql);
$res->bind_param("s",$username);
$res->execute();
$result=$res->get_result();
$row=$result->fetch_assoc();

if(!row){
	header("Location:login.php?status=1");
}

else{
	if($row['password']==$password){
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['status']=$row['status'];
		header("Location:admin.php");
	}
	else{
		header("Location:login.php?status=2");
	}
}

?>