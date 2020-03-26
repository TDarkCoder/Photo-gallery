<?php

    require_once("../../includes/initialize.php");
    include('../layouts/admin_header.php');
?>

    <div class="container">
        <h4 class="text-center">Media gallery</h4>
        <hr>
        <?php if(!empty($session->message)): ?>
            <div class="alert alert-success">
                <span><?=$session->message;?></span>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php

                $photos = Photo::find_all();
                foreach ($photos as $photo):

            ?>
                <div class="col-md-3 col-sm-4 col-6">
                    <img src="<?=path($photo->image_path())?>" width="100%" class="rounded-top">
                    <div class="border rounded-bottom p-2">
                        <p class="mb-1"><b>Caption:</b> <?=$photo->caption;?></p>
                        <p class="mb-1"><b>Type:</b> <?=$photo->type;?></p>
                        <p class="mb-0"><b>Size:</b> <?=$photo->size();?></p>
                        <hr>
                        <div class="text-center">
                            <a href="comments.php?id=<?=$photo->id;?>"><button type="button" class="btn btn-primary">Comments <?=count($photo->comments());?></button></a>
                            <a href="delete_photo.php?id=<?=$photo->id;?>"><button type="button" class="btn btn-danger">Delete</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="col-12 text-center mt-4">
                <a href="photo_upload.php"><button type="button" class="btn btn-success">Upload new photo</button></a>
            </div>
        </div>
    </div>

<?php
    include('../layouts/admin_footer.php');
?>
