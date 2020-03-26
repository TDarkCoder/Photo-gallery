<?php

    require_once("../../includes/initialize.php");

    $id = intval($_GET['id']);

    if(!empty($id)){

        $photo = Photo::find_by_id($id);

        if($photo){

            $photo->destroy();
            $session->message("Photo:$photo->filename was successfully deleted!");
            redirect_to('photos.php');

        }else{

            $session->message('File with this ID does not exist in database');
            redirect_to('photos.php');

        }

    }else{

        $session->message('No photo to delete');
        redirect_to('photos.php');

    }

    if(isset($db)) $db->disconnect();
?>
