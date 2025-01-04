<?php 
    echo $_GET['url'];
    require_once "../app/middleware.php";
    $app = new App();
    $app->index();
?>