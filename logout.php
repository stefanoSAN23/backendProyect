<?php 
    session_start();
    session_destroy();

    //redirect to login page
    header("location: ./index.php");
?>