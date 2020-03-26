<?php

    require_once("../../includes/initialize.php");
    include('../layouts/admin_header.php');
?>

<?php

    $post = $_POST;
    if(isset($post['upload'])){

        $photo = new Photo();
        $photo->caption = $post['caption'];
        $photo->attach_file($_FILES['filename']);
        if($photo->save()){
            $session->message("File was uploaded successfully");
            redirect_to('photos.php');
        }else{
            $message = $photo->error;
        }

    }

?>

    <div class="container">
        <div class="my-2 text-left">
            <a href="photos.php"><< Back</a>
        </div>
        <div class="card">
            <form method="post" enctype="multipart/form-data">
                <header class="card-header">
                    <h4 class="text-center">Upload photo</h4>
                </header>
                <?php echo !empty($message) ? output_message($message) : '' ?>
                <div class="card-body row m-0">
                    <div class="form-group col-md-6">
                        <label for="caption">Caption</label>
                        <input type="text" id="caption" class="form-control form-control-sm" name="caption">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="file">Choose photo</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <input type="file" id="file" class="form-control form-control-sm p-0" name="filename">
                    </div>
                    <div class="form-group col-12 text-left">
                        <button type="submit" name="upload" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    include('../layouts/admin_footer.php');
?>
