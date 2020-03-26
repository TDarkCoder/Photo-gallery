<?php

    require_once('../../includes/initialize.php');

    $id = intval($_GET['id']);

    if(!empty($id)){

        $comment = Comment::find_by_id($id);

        if($comment && $comment->delete()){

            redirect_to("comments.php?id=$comment->photo_id");

        }else{

            $session->message('Comment cannot be deleted, please try again later');
            redirect_to("comments.php?id=$comment->photo_id");

        }

    }else{

        $session->message('Comment with this ID does not exist');
        redirect_to('photos.php');

    }

    if(isset($db)) $db->disconnect();

?>
