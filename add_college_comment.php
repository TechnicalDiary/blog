<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php
    if(!isset( $_SESSION['user'])){
        die(http_response_code(401));
    } else {
        $userId = $_SESSION['user'];
        if (isset($_POST['comment']) && isset($_POST['articleId'])) {
            $post_comment = $_POST['comment'];
            $post_parentId = isset($_POST['parentId']) ? $_POST['parentId'] :null;
            $post_collegeId = isset($_POST['articleId']) ? $_POST['articleId'] :null;
            if($post_parentId){
                $sql = "INSERT INTO college_comments ( comment, parent_id,college_id, user_id ) VALUES ( '$post_comment', '$post_parentId', '$post_collegeId', '2' )";
            } else {
                $sql = "INSERT INTO college_comments ( comment, college_id, user_id ) VALUES ( '$post_comment', '$post_collegeId', '2' )";
            }
            if (mysqli_query($conn, $sql)) {
                $sql = "SELECT id as Id, user_id, comment as Comment, parent_id as ParentId, create_date as Date FROM college_comments WHERE college_id='$post_collegeId' AND user_id= 2 ORDER BY create_date desc LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $comment['UserAvatar']="static/images/Avtar.png";
                $comment['CanDelete'] = $comment['user_id']==$userId;
                $comment['Author'] = getUserNameByUserId($comment['user_id']);
                $comment['CanReply']=false;
                echo json_encode($comment);
            } else {
                    die(header("HTTP/1.0 401 Not Found"));
                    //echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
        } else {
            die(header("HTTP/1.0 401 Invalid Data"));
        }
    }

    function getUserNameByUserId($user_Id){
        if($user_Id=='1'){
            return "User_One";
        }
        if($user_Id=='2'){
            return "User_Two";
        }
        if($user_Id=='3'){
            return "User_Three";
        }
        else{
            return "User_Four";
        }
    }
?>