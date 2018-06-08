<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php

    if (isset($_POST['getData'])) {
        $start = $conn->real_escape_string($_POST['start']);
        $limit = $conn->real_escape_string($_POST['limit']);

        $sql = "SELECT * FROM posts LIMIT $start, $limit";
        
        $result = mysqli_query($conn, $sql);
        // fetch all posts as an associative array called $posts
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);


        if($posts ){
            $response = "";
            $final_posts = array();
            foreach ($posts as $post) {
                $post['topic'] = getPostTopic($post['id']); 
                array_push($final_posts, $post);
            }

            foreach ($final_posts as $post) {
                $response .='<div class="post" style="margin-left: 0px;">
                <img src="'. BASE_URL . '/static/images/' . $post['image'].'" class="post_image" alt="">';
                if (isset($post['topic']['name'])){
                    $response .= '
                        <a href="'. BASE_URL . '/filtered_posts.php?topic=' . $post['topic']['id'].'" 
                        class="btn category">'.$post['topic']['name'] .'</a>';
                }
                $response .='<a href="single_post.php?post-slug='. $post['slug'] .'">
                    <div class="post_info">
                    <h3>'. $post['title'] . '</h3>
                    <div class="info">
                    <span>'. date("F j, Y ", strtotime($post["created_at"])).'</span>
                    <span class="read_more">Read more...</span>
                    </div>
                    </div>
                    </a></div>';
            }
            exit($response);
        } else {
            // echo '<script>alert("error")<script>';
            exit("reachedMax");
        }
    }
?>