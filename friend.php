<?php
include ('nav.php');
include ('db.php');
include ('cdn.php');
?>
<div class="container">
	<h3 class="text-center mt-5 pt-5">FRIEND LIST</h3>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
<?php
$limit=2;
$sql=mysqli_query($conn, "SELECT * FROM user WHERE id!='".$_SESSION['id']."'");
$total=mysqli_num_rows($sql);
$page=ceil($total/$limit);
$start=0;
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}else{
	$id=1;
}
$sql1=mysqli_query($conn, "SELECT * FROM user WHERE  id!='".$_SESSION['id']."' LIMIT $start,$limit");
while($friend=mysqli_fetch_assoc($sql1)){
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


			 <ul class="pagination justify-content-center">
<?php
if($id>1){
?>
        	  <li class="page-item"><a class="page-link" href="?id=<?php echo $id-1; ?>">Previous</a></li>
<?php }
for ($i=1; $i <=$page ; $i++) {
?>
        	  <li class="page-item"><a class="page-link" href="?id=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php } if($id<$page){ ?>
        	  <li class="page-item"><a class="page-link" href="?id=<?php echo $id+1; ?>">Next</a></li>
<?php } ?>
 			 </ul>
		</div>
	</div>
</div>


<!-- ................ Mail Modal................ -->
<div class="modal fade" id="mail_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i>Mail Form</i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="mail.php" method="POST" >
        	<input type="text" name="to_mail" placeholder="Enter to_mail" class="form-control to_mail"><br>
        	<input type="text" name="from_email" value="<?php echo $user['email']; ?>" placeholder="Enter from_email" class="form-control"><br>
        	<input type="text" name="subject" placeholder="Enter subject" class="form-control"><br>
        	<textarea class="form-control" name="message" rows="6" placeholder="Enter Message"></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-secondary"><i class="fas fa-registered mr-1"></i>Create</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
	$('.mbtn').click(function(){
		var to_mail=$(this).attr('to_mail');
		$('.to_mail').val(to_mail);
	})
</script>