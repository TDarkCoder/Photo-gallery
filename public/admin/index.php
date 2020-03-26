<?php

    require_once("../../includes/initialize.php");
    include('../layouts/admin_header.php');
    $user = User::find_by_id($_SESSION['user_id']);
?>

    <div class="container">
        <h2>Photo gallery: Admin</h2>
        <hr>
        <h4><?=$user->full_name(); ?></h4>
        <p><b>Username:</b> @<?=$user->username;?></p>
    </div>

<?php
    include('../layouts/admin_footer.php');
?>
