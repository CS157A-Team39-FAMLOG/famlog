<?php   
    if (session_status()) {
        require 'navigation.php';
        echo 'Welcome, '.$_SESSION['accountName'];
        echo 'This is the account shopping list home.';
    } else {
        header("Location: ../index.php");
    }
?>
