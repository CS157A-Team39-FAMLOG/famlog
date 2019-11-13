<?php    
    if (isset($_SESSION)) {
        require 'navigation.php';
        echo 'Welcome, '.$_SESSION['accountName'];
    } else {
        header("Location: ../index.php");
    }
?>
