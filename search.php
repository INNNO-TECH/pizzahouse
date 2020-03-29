<?php
include ('db.php');
include ('cdn.php');
if(isset($_POST))
{
	$name=$_POST['name'];
	$sql=mysqli_query($conn, "SELECT * FROM user WHERE name LIKE '%$name%'");
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php
			while($friend=mysqli_fetch_assoc($sql)){
	echo '<div class="media border mb-2">
			  <div class="media-left">
			    <img src="img/'.$friend['photo'].'" class="media-object rounded-circle m-2" style="width:60px">
			  </div>
			  <div class="media-body">
			    <h6 class="media-heading mt-3">'.$friend['name'].'</h6>
			    <p>'.$friend['address'].'</p>
			    <button class="btn btn-info mb-2 mbtn"  data-toggle="modal" data-target="#mail_Modal" to_mail="'.$friend['email'].'">Send Mail</button>
			  </div>
			</div>';
	
} 
			?>
		</div>
	</div>
</div>