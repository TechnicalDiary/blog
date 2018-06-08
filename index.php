
<!-- https://codewithawa.com/posts/how-to-create-a-blog-in-php-and-mysql-database---db-design -->


<!-- The first include should be config.php -->
<?php require_once('config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>LifeBlog | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		<!-- navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // navbar -->

		<!-- banner -->
		<?php include( ROOT_PATH . '/includes/banner.php') ?>
		<!-- // banner -->

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>
			<!-- more content still to come here ... -->

            <!-- Add this ... -->
            <div class="result">
            
            </div>
		</div>
        <div class="ajax-load text-center" style="text-align:center;display:none;">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script >
        var start = 0;
        var limit = 8;
        var reachedMax = false;

        $(document).ready(function () {
            getData();
        });

        $(window).scroll(function () {
            if ($(window).scrollTop() == $(document).height() - $(window).height())
                getData();
        })

        function getData() {
            if (reachedMax)
                return;
            $(".ajax-load").show();
            $.ajax({
                url:'loadMoreData.php',
                method: 'POST',
                dataType:'text',
                data: {
                    getData: 1,
                    start: start,
                    limit:limit
                },
                success: function(resposnse){
                    if(resposnse=="reachedMax"){
                        reachedMax = true;
                    } else {
                        start += limit;
                        $(".result").append(resposnse);
                    }
                    $(".ajax-load").hide();
                }
            })
        }

    </script>

    <style>
        .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
    </style>