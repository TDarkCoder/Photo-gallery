<?php

    require_once('../../includes/initialize.php');

    $id = intval($_GET['id']);

    if(!empty($id)){

        $photo = Photo::find_by_id($id);

        if(!$photo){

            $session->message('This photo did not exist or was deleted.');
            redirect_to('index.php');

        }

    }else{

        $session->message('This photo did not exist or was deleted.');
        redirect_to('index.php');

    }

    include('../layouts/admin_header.php');

    $comments = $photo->comments();

?>

    <div class="container">
        <div class="my-2 text-left">
            <a href="photos.php"><< Back</a>
        </div>
        <div class="w-100">
            <?php if (!empty($session->message)): ?>
                <div class="alert alert-danger">
                    <?=$session->message;?>
                </div>
            <?php endif ?>
            <h4>Comments on <?=$photo->caption;?></h4>
            <?php foreach ($comments as $comment): ?>
                <div class="border-bottom py-2 mt-1">
                    <h6><?=$comment->author;?> <small>(<?=calendar($comment->created_at);?>)</small></h6>
                    <p class="mb-1"><?=$comment->body;?></p>
                    <a href="delete_comment.php?id=<?=$comment->id;?>" class="text-danger">Delete</a>
                </div>
            <?php endforeach ?>
            <?php if (empty($comments)): ?>
                <h5 class="my-4 text-center">No comments</h5>
            <?php endif ?>
        </div>
    </div>

<?php
    include('../layouts/admin_footer.php');
?>
