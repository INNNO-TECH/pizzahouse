<!DOCTYPE html>
<html>
<head>
	<title>Lobelia</title>
	<?php include('cdn.php'); ?>

<style type="text/css">
	.side_left li,.side_right li{
		background:#F7F7F7;
	}
	.react{
		display: flex;
	}
	.react div{
		width: 33%;
		text-align: center;
	}
</style>
</head>
<body style="background:#E9EBEE;">
<?php include ('nav.php');
if(!$_SESSION['id']){
	header("location:index.php");
}
?>
<div class="container-fluid" style="margin-top: 80px;">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group side_left">
			  <li class="list-group-item">Cras justo odio</li>
			  <li class="list-group-item"><a href="friend.php">Friend</a></li>
			  <li class="list-group-item">Morbi leo risus</li>
			  <li class="list-group-item">Porta ac consectetur ac</li>
			  <li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</div>


		<div class="col-md-5">
			<div class="card mb-3">
				<div class="card-header"><b>Create Posts</b></div>
				<div class="card-body">
					
				<div class="media">
				  <img src="img/<?php echo $user['photo']; ?>" width="50px;" class="mr-3 rounded-circle" alt="...">
				  <div class="media-body">
				    <textarea class="form-control" data-toggle="modal" data-target="#create_post_Modal"></textarea>
				  </div>
				</div>

				</div>
				<div class="card-footer bg-white">
					<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="fas fa-images mr-1"></i>Photo/Video</button>
					<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="fas fa-plus-circle text-white mr-1"></i>Create</button>
					<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create_post_Modal"><i class="far fa-smile mr-1"></i>Feeling/Activity</button>
				</div>
			</div>

<?php
$sql1=mysqli_query($conn,"SELECT post.*,user.name,user.photo FROM post INNER JOIN user ON post.user_id=user.id ORDER by id DESC");
while($post=mysqli_fetch_assoc($sql1)){
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
					<div><i class="far fa-thumbs-up mr-1"></i>like</div>
					<div><a href="comment.php?id=<?php echo $post['id']; ?>"><i class="far fa-comment-alt mr-1"></i>Comment</a></div>
					<div><i class="fas fa-share mr-1"></i></i>Share</div>
				</div>
			</div>
<?php } ?>

		</div>


		<div class="col-md-3">
			<div class="alert" style="background:#fff;">
				<b>Popular Author</b><hr>
			<div class="media border mb-2">
			  <div class="media-left">
			    <img src="img/3.jpg" class="media-object rounded-circle m-2" style="width:60px">
			  </div>
			  <div class="media-body">
			    <h6 class="media-heading mt-3">Media Middle</h6>
			    <p>Lorem ipsum...</p>
			  </div>
			</div>

			<div class="media border mb-2">
			  <div class="media-left">
			    <img src="img/3.jpg" class="media-object rounded-circle m-2" style="width:60px">
			  </div>
			  <div class="media-body">
			    <h6 class="media-heading mt-3">Media Middle</h6>
			    <p>Lorem ipsum...</p>
			  </div>
			</div>


			</div>
		</div>
		<div class="col-md-2">
			<ul class="list-group side_right active_area" >
			
			 
			</ul>
		</div>
	</div>
</div>

<!-- ................Create Posts Modal................ -->
<div class="modal fade" id="create_post_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i>Create Posts</i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="post/insert.php" method="POST" enctype="multipart/form-data">
        	<input type="text" name="title" placeholder="Enter Title" class="form-control"><br>
        	<textarea name="description" placeholder="What's on your mind?" class="form-control"></textarea><br>
        	<b>Photo : </b><input type="file" name="photo">
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
	$(document).ready(function(){
$('.active_area').load("online_user.php");
active_refresh();
	});
	function active_refresh(){
		setTimeout(function(){
			$('.active_area').load("online_user.php");
			active_refresh();
		},1000);
	}
</script>
</body>
</html>