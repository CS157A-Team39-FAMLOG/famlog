<?php
    session_start();
?>

<style>

<?php
    include 'css/navigationStyle.css';
    include 'css/signupStyle.css';
?>
</style>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Navbar Styling -->
    <link rel="stylesheet" type="text/css" href="css/navigationStyle.css">

    <!-- Styling for signup.php-->
    <link rel="stylesheet" href="css/signupStyle.css">

    <title>FAMLOG</title>
</head>
<body>
     <!------------- Navbar Setup ---------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between main">
        
        <a class="navbar-brand" href="index.php">
            <img class="navbar-logo" src="images/famlog_logo.png" alt="logo">
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        
        if (isset($_SESSION['accountName'])) {
            echo '
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-3">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home&nbsp &nbsp|<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="personalHome.php">Personal Lists &nbsp|</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchaseHistory.php">Purchase History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-shopping-cart" style="font-size:30px"></i></a>
                        </li>
                    </ul>
                    <form class="form-group my-2 my-lg-0" action="functional/logout_functional.php" method="post">
                        <button  class="btn btn-secondary" type="submit" name="logout">Logout</button>
                    </form>
                </div>
                  ';
          } else {
            echo '
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <form class="form-inline my-2 my-lg-0 justify-content-end" action="functional/login_functional.php" method="post">
                        <input class="form-control mr-sm-2" type="text" name="loginAcctName" placeholder="Account Name">
                        <input class="form-control mr-sm-2" type="password" name="loginPwd" placeholder="Password">
                        <button class="btn btn-primary" type="submit" name="login">Login</button> 
                        <button class="btn btn-success signup-btn navbar-right-pos" type="button" name="signup"><a class="button-link" href="signup.php">Signup</a></button> 
                    </form>
                </div>
              ';
          }

        ?>
      
    </nav>
    <!------------- Navbar End ---------------------->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>