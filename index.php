<?php 
  require "navigation.php";
?>

  <main>
    <?php
      if (isset($_SESSION['accountName'])) {
        echo '<p>You are logged in.</p>';
      } else {
        echo '<p>You are logged out.</p>';
      }
    ?>
  </main>

<?php 
  require "footer.php";
?>