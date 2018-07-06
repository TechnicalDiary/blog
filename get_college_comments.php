<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php 
    $userId = 2;
    function getComments($collegeID){
        global $conn;
        $sql = "SELECT id as Id, user_id, comment as Comment, parent_id as ParentId, create_date as Date FROM college_comments WHERE college_id = $collegeID AND deleted ='0'";
        $result = mysqli_query($conn, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $comments;
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


	if (isset($_GET['collegeId'])) {
        $comments = getComments($_GET['collegeId']);
        array_walk($comments, function (& $item) { 
            global $userId;
            $item['UserAvatar']="static/images/Avtar.png";
            $item['CanDelete'] = $item['user_id']==$userId;
            $item['Author'] = getUserNameByUserId($item['user_id']);
            $item['CanReply']=true;
         });
        echo json_encode($comments);
	} else {
        echo json_encode([]);
    }
?>