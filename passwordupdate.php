<?php


if (isset($_POST['reset-password-submit'])) {

  // Retrieves data entered by the user
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];
 //error handling 
  if (empty($password) || empty($passwordRepeat)) {
    header("Location: signup.php?newpwd=empty");
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: signup.php?newpwd=pwdnotsame");
    exit();
  }

  // Sets current date as the time
  $currentDate = date('U');

  
  require 'dbh.inc.php';

 //Retrieves token through a selector as a more secure solution

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $currentDate";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error, please try again.";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $selector);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      echo "Session timed out";
      exit();
    } else {


      //converts token into hexadecimal
      $tokenBin = hex2bin($validator);

      // Verifies token authenticity before accessing database
      $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

     
      if ($tokenCheck === false) {
        echo "Error";
      } elseif ($tokenCheck === true) {

        //Stores the token email into the database for later use
        $tokenEmail = $row['pwdResetEmail'];

        // Checks database for the email the user provided in the form
        $sql = "SELECT * FROM users WHERE usersEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "Error, please try again.";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($result)) {
            echo "Error, please try again.";
            exit();
          } else {

            // "users" table in the loginsystem database is changed with the new password 
            $sql = "UPDATE users SET usersPwd=? WHERE usersEmail=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "Error, please try again.";
              exit();
            } else {
              $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
              mysqli_stmt_execute($stmt);

              // Removes token email from the "pwdreset" table
              $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Error, please try again.";
                exit();
              } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: signup.php?newpwd=passwordupdated");
              }

            }

          }
        }

      }

    }
  }

} else {
  header("Location: index.php");
  exit();
}
