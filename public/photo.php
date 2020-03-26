<?php

    require_once('../includes/initialize.php');

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

    include('layouts/header.php');

?>

    <?php

        $post = $_POST;
        if(isset($post['submit'])){

            $author = trim($post['author']);
            $body = trim($post['body']);

            $comment = Comment::make($photo->id, $author, $body);

            if($comment && $comment->save()){

                $session->message('Comment is sent successfully');
                redirect_to("photo.php?id=$photo->id");

            }else{

                $message = "Message sending prevention, please, make sure you fill in the blank!";

            }

        }else{

            $author = "";
            $body = "";

        }

        $comments = $photo->comments();

    ?>

    <div class="container">
        <div class="my-2 text-left">
            <a href="./"><< Back</a>
        </div>
        <div class="w-100">
            <h5 class="text-center"><?=$photo->caption;?></h5>
            <hr>
            <img src="<?=$photo->image_path();?>" width="100%">
        </div>

        <hr>

        <!-- Photo comments -->

        <h4 class="text-center">Leave comment</h4>
        <?php
            if(!empty($message)):
        ?>
        <div class="alert alert-danger">
            <span><?=$message;?></span>
        </div>
        <?php endif; ?>
        <?php
            if(!empty($session->message)):
        ?>
        <div class="alert alert-success">
            <span><?=$session->message;?></span>
        </div>
        <?php endif; ?>
        <form method="post">
            <div class="row">
                <div class="form-group col-md-7 col-12">
                    <label for="author">Your name:</label>
                    <input type="text" class="form-control form-control-sm" id="author" value="<?=$author ?? ''?>" name="author">
                </div>
                <div class="form-group col-md-7 col-12">
                    <label for="body">Your message:</label>
                    <textarea id="body" name="body" class="form-control" row="5"><?=$body ?? ''?></textarea>
                </div>
                <div class="form-group col-12 text-left">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
            </div>
        </form>
        <div class="w-100">
            <?php foreach ($comments as $comment): ?>
                <div class="border-bottom py-2 mt-1">
                    <h6><?=$comment->author;?> <small>(<?=calendar($comment->created_at);?>)</small></h6>
                    <p class="mb-1"><?=$comment->body;?></p>
                </div>
            <?php endforeach ?>
            <?php if (empty($comments)): ?>
                <h5 class="my-4 text-center">No comments</h5>
            <?php endif ?>
        </div>
    </div>

<?php
    include('layouts/footer.php');
?>
