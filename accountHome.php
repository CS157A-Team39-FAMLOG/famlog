<?php   
    if (session_status()) {
        require 'navigation.php';
        echo 'Welcome, '.$_SESSION['accountName']."!<br>";
        echo 'This is the account shopping list home.';
    } else {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/personalStyle.css">
</head>
<body>
</body>
</html>