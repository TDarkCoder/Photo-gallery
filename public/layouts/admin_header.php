<?php
    if(!$session->is_logged_in()) redirect_to('login.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photo gallery: Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?=path('css/bootstrap.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=path('css/style.css')?>">
</head>
</head>
<body>

    <?php

        $post = $_POST;

        if(isset($post['logout'])){

            $session->logout();
            redirect_to('login.php');

        }

    ?>

    <header>
        <nav class="navbar navbar-light bg-light">
            <a href="/photogallery/public/" class="navbar-brand">Photo gallery</a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photos.php">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photo_upload.php">+ photo</a>
                </li>
            </ul>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <?php
                if($session->is_logged_in())
            ?>
                <form method="post" class="form-inline">
                    <button class="btn btn-primary" name="logout" type="submit">Logout</button>
                </form>
            <?endif;?>
        </nav>
    </header>
