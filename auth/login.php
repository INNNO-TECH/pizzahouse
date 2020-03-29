<?php
session_start();
include ('../db.php');
if(isset($_POST))
{
$name=$_POST['name'];
$password=$_POST['password'];
$sql=mysqli_query($conn, "SELECT * FROM user WHERE name='$name' AND password='$password'");
$row=mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
	$_SESSION['id']=$row['id'];
	$sql1=mysqli_query($conn,"SELECT * FROM online_user WHERE id='".$row['id']."'");
	if(mysqli_num_rows($sql1)>0){
		header("location:../home.php");
	}else{
		mysqli_query($conn,"INSERT INTO online_user(user_id) VALUES ('".$_SESSION['id']."')");
		header("location:../home.php");
	}
	
}else{
	echo "<script>alert('login fail!');window.location.href='../index.php'</script>";
}

}
?>