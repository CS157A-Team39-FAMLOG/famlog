<?php 
  require "navigation.php";
?>


  <main>
      <div class="container">
        <?php
          if (isset($_SESSION['accountName'])) {
            echo '<p>You are logged in.</p>';
           
          } else {
            echo '<div class="line-1 anim-typewriter">Welcome to FAMLOG</div>';
            checkLoginErrors();
          }
        ?>
    </div>
  </main>

<?php
  function checkLoginErrors() {
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "emptyfield") {
        echo '<div class="login-error">Please fill in the blanks.</div>';
      } else if ($_GET['error'] == "wrongPassword" || $_GET['error'] == "wrongPassw") {
        echo '<div class="login-error">This is a wrong password.</div>';
      } else if ($_GET['error'] == "userDoesNotExist") {
        echo '<div class="login-error">This user does not exist. Please sign up!</div>';
      }
    }
  }
?>

<?php 
  require "footer.php";
?>