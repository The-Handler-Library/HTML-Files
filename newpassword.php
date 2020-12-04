<?php
  require 'header.php';
?>

<main>
 

      <?php
      // Gets tokens from URL
      $selector = $_GET['selector'];
      $validator = $_GET['validator'];

      //Checks user has tokens 
      if (empty($selector) || empty($validator)) {
        echo "No user token found.";
      } else {
        // Ensures URL was not changed by user
        // Shpws form to user if true
        if (ctype_xdigit( $selector ) !== false && ctype_xdigit( $validator ) !== false) {
          ?>

          <form class="form-resetpwd" action="passwordupdate.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector ?>">
            <input type="hidden" name="validator" value="<?php echo $validator ?>">

            <input type="password" name="pwd" placeholder="Enter new password...">
            <input type="password" name="pwd-repeat" placeholder="Repeat new password...">
            <button type="submit" name="reset-password-submit">Reset password</button>
          </form>

          <?php
        }
      }
      ?>

   
</main>

