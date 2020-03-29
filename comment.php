
<!DOCTYPE html>
<html>
<head>
	<title>Lobelia</title>
	<?php include('cdn.php'); ?>

</head>
<body style="background:#E9EBEE;">
<?php include ('nav.php');
if(!$_SESSION['id']){
	header("location:index.php");
}
?>
<div class="container-fluid" style="margin-top: 80px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-5">

<?php
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$_SESSION['pid']=$id;
$sql1=mysqli_query($conn,"SELECT post.*,user.name,user.photo FROM post INNER JOIN user ON post.user_id=user.id WHERE post.id='$id' ORDER by id DESC");
$post=mysqli_fetch_assoc($sql1);
?>
			<div class="card mb-2">
				<div class="card-header bg-white">			
					<img src="img/<?php echo $post['photo']; ?>" width="30px" class="rounded-circle mr-1">
					<b><?php echo $post['name']; ?></b>				
					<div style="float: right;">
<?php
if($_SESSION['id']==$post['user_id']){
?>
						<i class="fas fa-chevron-circle-left text-info mr-1"></i>
						<i class="fas fa-times-circle text-success"></i>
<?php } ?>
					</div>
				</div>
				<div class="card-body">
					<h6><?php echo $post['title'] ?></h6>
					<p class="text-justify">
						<?php echo $post['description']; ?>
					</p>
					<img src="img/<?php echo $post['post_photo'] ?>" width="100%;">
				</div>
				<div class="card-footer react bg-white">
					<div class="media mb-2">
			  <div class="media-left">
			    <img src="img/3.jpg" class="media-object rounded-circle m-2" style="width:35px">
			  </div>
			  <div class="media-body">
			  	<input type="" class="post_id" value="<?php echo $id; ?>">
			  	<input type="" class="user_id" value="<?php echo $_SESSION['id']; ?>">
			  <textarea class="form-control mb-2 comment"></textarea>
			   <button class="btn btn-dark cbtn">Send</button>
			  </div>
			</div>
				</div>
			</div>
<?php } ?>
<div class="comment_area"></div>

		</div>

		<div class="col-md-3"></div>
		<div class="col-md-2"></div>
	</div>
</div>
<script type="text/javascript">
	$('.cbtn').click(function(){
		var post_id=$('.post_id').val();
		var user_id=$('.user_id').val();
		var comment=$('.comment').val();
		$.ajax({
			url:"comment/insert.php",
			type:"POST",
			data:{post_id:post_id,user_id:user_id,comment:comment},
			success:function(data){
				$('.comment').val("");
			}
		});

	});

	$(document).ready(function(){
$('.comment_area').load("comment/select.php");
comment_refresh();
	});
	function comment_refresh(){
		setTimeout(function(){
			$('.comment_area').load("comment/select.php");
			comment_refresh();
		},1000);
	}
</script>
</body>
</html>