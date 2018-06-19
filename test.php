<?php  include('config.php'); ?>
<?php 
	$errors = array(); 
    $username='';
    if (isset($_POST['add_title'])) {
		$username = $_POST['username'];
		$slug = $_POST['slug'];

		if (empty($username)) { array_push($errors, "Username required"); }
		if (empty($slug)) { array_push($errors, "slug required"); }
		if (empty($errors)) {
			$sql = "SELECT * FROM string_slug WHERE slug='$slug'";

			$result = mysqli_query($conn, $sql);
			var_dump($result);
			if (mysqli_num_rows($result) < 1) {

			} else {
				array_push($errors, 'Unable to add duplicate slug');
			}
		}
	}
?>
<?php  include('includes/head_section.php'); ?>
	<title>LifeBlog | Sign in </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<?php include(ROOT_PATH . '/includes/errors.php') ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="" >
			<div class="form-group">
				<input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" onChange="generateSlug()">
			</div>
			<div class="form-group has-feedback">
				<input type="text" id="slug" name="slug" class="form-control" placeholder="Url" required>
				<span class="glyphicon form-control-feedback slug-feedback" aria-hidden="true"></span>
				<div id="slug-help-block" class="help-block"></div>
			</div>
			<button type="submit" class="btn" name="add_title">Add</button>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->

<script>
    function generateSlug(){
        var username = $("#username").val();
        var slug = username.replace(/\s+/g, '-').toLowerCase();
        $("#slug").val(slug);
		checkSlugAvailability();
    }

	function checkSlugAvailability(){
		var slug = $("#slug").val();
		$.ajax({
			url:'checkSlugAvailability.php',
			method:'POST',
			dataType:'text',
			data:{
				checkSlugAvailability:1,
				slug:slug
			},
			success: function(response){
				if(response=="available"){
					$("#slug-help-block").text("available");
					$("#slug").parent().removeClass('has-error').addClass('has-success');
					$(".slug-feedback").removeClass('glyphicon-remove').addClass('glyphicon-ok');
				} else if(response=="unavailable"){
					$("#slug-help-block").text("unavailable");
					$("#slug").parent().removeClass('has-success').addClass('has-error');
					$(".slug-feedback").removeClass('glyphicon-ok').addClass('glyphicon-remove');
				}
			},
			error: function(err){
				console.log(err);
			}
		})

	}

</script>
<style>
	.slug-error{
		border:1px solid red;
	}
	.slug-success{
		border:1px solid green;
	}
</style>