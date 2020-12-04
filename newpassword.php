<?php
  require 'header.php';
?>

<main>
 

      <?php
      // First we grab the tokens from the URL.
      $selector = $_GET['selector'];
      $validator = $_GET['validator'];

      // Then we check if the tokens are here.
      if (empty($selector) || empty($validator)) {
        echo "No user token found.";
      } else {
        // Here we check if all characters in our tokens are hexadecimal 'digits'. This is a boolean. Again another error check to make sure the URL wasn't changed by the user.
        // If this check returns "true", we show the form that the user uses to reset their password.
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

