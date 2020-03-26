<?php

    require_once('../includes/initialize.php');

    include('layouts/header.php');

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
                        <h5 class="m-0"><?=$photo->caption;?></h5>
                        <hr>
                        <div class="text-center">
                            <a href="photo.php?id=<?=$photo->id;?>"><button type="button" class="btn btn-outline-info">Watch</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

<?php
    include('layouts/footer.php');
?>
