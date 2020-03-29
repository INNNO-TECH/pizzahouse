<?php
include ('../db.php');
if(isset($_POST))
{
	$name=$_POST['name'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];

	//$password=$_POST['password'];
	//echo hash('md5',$password);
	

	$photo=$_FILES['photo']['name'];
	$tmp=$_FILES['photo']['tmp_name'];
	if($photo){
		move_uploaded_file($tmp,"../img/$photo");
	}

	$query=mysqli_query($conn,"SELECT * FROM user WHERE name='$name'");
	if(mysqli_num_rows($query)>0){
		echo "<script>alert('username already exist');window.location.href='../index.php'</script>";
	}else if($password==$cpassword){
		mysqli_query($conn, "INSERT INTO user (name,password,c_password,email,phone,dob,gender,photo,address,created_date,modified_date) VALUES ('$name','$password','$cpassword','$email','$phone','$dob','$gender','$photo','$address',now(),now())");
		echo "<script>alert('Successfully registered');window.location.href='../index.php'</script>";
	}else{
		echo "<script>alert('password do not match');window.location.href='../index.php'</script>";
	}

}

?>