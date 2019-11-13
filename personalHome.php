<?php   
    if (session_status()) {
        require 'navigation.php';
        echo 'Welcome, '.$_SESSION['accountName'];
    } else {
        header("Location: ../index.php");
    }
?>
