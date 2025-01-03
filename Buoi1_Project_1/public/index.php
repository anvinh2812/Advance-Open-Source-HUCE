<?php 
    // echo "Vinh"; index -> middleware -> app(trong app co core de lam router)
    echo $_GET['url'];
    require_once "../app/middleware.php";
    $app = new App();
    $app->index();
?>