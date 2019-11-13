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
     
    <!-- Navbar Styling -->
    <link rel="stylesheet" type="text/css" href="css/navigationStyle.css">

    <!-- Styling for signup.php-->
    <link rel="stylesheet" href="css/signupStyle.css">

    <title>FAMLOG</title>
</head>
<body>
     <!------------- Navbar Setup ---------------------->
    <nav class="navbar navbar-light bg-light">
        
        <a class="navbar-brand" href="index.php">
            <img class="navbar-logo" src="images/famlog_logo.png" alt="logo">
        </a> 

        <?php
        
        if (isset($_SESSION['accountName'])) {
            echo '
                  <div class="form-inline">
                    <button class="btn btn-success signup-btn" type="button" name="signup"><a class="signup-link" href="signup.php">Signup</a></button>                    
                    <button class="btn btn-success signup-btn" type="button" name="signup"><a class="signup-link" href="signup.php">Signup</a></button>
                    <form class="form-group my-2 my-lg-0 navbar-form-pos" action="functional/logout_functional.php" method="post">
                        <button  class="btn btn-secondary" type="submit" name="logout">Logout</button>
                    </form>
                  </div>
                  ';
          } else {
            echo '<form class="form-inline my-2 my-lg-0" action="functional/login_functional.php" method="post">
                    <input class="form-control mr-sm-2" type="text" name="loginAcctName" placeholder="Account Name">
                    <input class="form-control mr-sm-2" type="password" name="loginPwd" placeholder="Password">
                    <button class="btn btn-primary" type="submit" name="login">Login</button> 
                    <button class="btn btn-success signup-btn" type="button" name="signup"><a class="signup-link" href="signup.php">Signup</a></button> 
                  </form>
                  
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