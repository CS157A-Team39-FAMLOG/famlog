<?php 
  require "navigation.php";
?>


  <main>
      <div class="container">
        <?php
          if (isset($_SESSION['accountName'])) {
            echo '<p>You are logged in.</p>';
          } else {
            checkLoginErrors();
            echo '<p>You are logged out.</p>';
          }
        ?>
    </div>
  </main>

<?php
  function checkLoginErrors() {
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "emptyfield") {
        echo '<p class="signup-error">Please fill in the blanks.</p>';
      } else if ($_GET['error'] == "wrongPassword" || $_GET['error'] == "wrongPassw") {
        echo '<p class="signup-error">This is a wrong password.</p>';
      } else if ($_GET['error'] == "userDoesNotExist") {
        echo '<p class="signup-error">This user does not exist. Please sign up!</p>';
      }
    }
  }
?>

<?php 
  require "footer.php";
?>