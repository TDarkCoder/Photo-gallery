<?php

    require_once("../../includes/initialize.php");

    if($session->is_logged_in()) redirect_to('index.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>

    <?php

        $post = $_POST;

        if(isset($post['submit'])){

            $username = $post['username'];
            $password = $post['password'];

            $user = User::authenticate($username, $password);

            if($user){

                $session->login($user);
                redirect_to('index.php');

            }else{

                $message = "Invalid username or password";

            }

        }

    ?>

    <header>
        <nav class="navbar navbar-light bg-light">
            <a href="/photogallery/public/" class="navbar-brand">Photo gallery</a>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </header>
    <div class="container">
        <?=(!empty($message)) ? output_message($message) : '';?>
        <form method="post" class="my-3">
            <div class="card">
                <header class="card-header">
                    <h4 class="text-center col-12">Login</h4>
                </header>
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" class="form-control form-control-sm" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" class="form-control form-control-sm" name="password">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" class="btn btn-success">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
        $db->disconnect();
    ?>
</body>
</html>
