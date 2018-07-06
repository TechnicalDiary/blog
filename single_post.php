<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
	$errors = array(); 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | LifeBlog</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="static/css/jquery.comment.min.css" />
<!-- <script src="static/js/jquery.comment.js"></script> -->
<script src="static/js/com.js"></script>
<script src="https://jqcomment.herokuapp.com/js/prettify.js"></script>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
	
	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="text-center" style="text-align:center;">
					<img src="static/images/<?php echo $post['image'] ?>" class="post_image" alt="">
				</div>
				<div class="post-body-div">
					<?php echo html_entity_decode($post['body']); ?>
				</div>
				<input type="hidden" class="articleId" value="<?php echo $post['id'] ?>">
				<br><br><br>
				<div id="commentSection"></div>
			<?php endif ?>
			</div>
			<!-- // full post div -->
			
			<!-- comments section -->
			<!--  coming soon ...  -->
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a href="<?php echo BASE_URL . '/filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->
<script>
	$(document).ready(function () {
		$(document).ready(function () { window.prettyPrint && prettyPrint(); });
		$("#commentSection").comments({
			getCommentsUrl: "get_college_comments.php?collegeId=1",
			postCommentUrl: "add_college_comment.php",
			deleteCommentUrl: "JqComment/DeleteComment",
			displayAvatar: true,
			loadWhenVisible: true,
			callback: {
				beforDelete: function() {
					return confirm("Are you sure you want to Delete comment?");
				},
				beforeCommentAdd: function() {
					alert("you must be logedin before post comment");
					return false;
				},
				afterCommentAdd: function(comment) {
					console.log(comment);
					return false;
				},
				onPostError: function(){
					return alert("post Error");
				}
			}
		});
	})
</script>

<?php include( ROOT_PATH . '/includes/footer.php'); ?>

<!-- https://jqcomment.herokuapp.com/#commentStructure -->