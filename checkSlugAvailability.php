<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php

    if (isset($_POST['checkSlugAvailability'])) {
        $slug = $conn->real_escape_string($_POST['slug']);

        $sql = "SELECT * FROM string_slug WHERE slug='$slug'";
        
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $slugs = mysqli_fetch_all($result, MYSQLI_ASSOC);


        if($slugs){
            $response = "unavailable";
            exit($response);
        } else {
            exit("available");
        }
    }
?>