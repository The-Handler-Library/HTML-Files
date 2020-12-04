<?php

// First we check if the form was submitted.
if (isset($_POST['reset-request-submit'])) {

 //Creates token for the user requesting a new password. 
 //Tokens are a security measure to ensure the correct user and account are being changed in the "users" database. 
 //Tokens are then encrypted through bin2hex and random_bytes.
    
 //Selectors are important for creating a secure method.

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

 

 //URL sent to the user via sendmail.exe using secure selector and converting token into a hexadecimal


  $url = "localhost/newpassword.php?selector=" . $selector . "&validator=" . bin2hex($token);

  //Tokens must expire as it's meant to be a temporary item. 
  $expires = date("U") + 1800;

 

  
  require 'dbh.inc.php';

  //Retrieves user email from the from previously filled out.
  $userEmail = $_POST["email"];

  //Placeholders are now deleted from the database 
  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error!";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  // Here we then insert the info we have regarding the token into the database. This means that we have something we can use to check if it is the correct user that tries to change their password.
  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error!";
    exit();
  } else {
    //Token is hashed using standard php encrption
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  //Email form on what actually gets sent to the user and what acccount will send it. Here we use capstonelibraryproject@gmail.com as our account to send mail from through sendmail.exe and Xampp
  // Who are we sending it to.
  $to = $userEmail;
  $subject = 'Reset your password for the Handler Library';
  $message = '<p>To reset your password, please click the link below and follow the instructions. ';
  $message .= 'If you did not make this request, please contact the Handler Library at our return Email address.</p>';
  $message .= '<p>Password reset link: </br>';
  $message .= '<a href="' . $url . '">' . $url . '</a></p>';
  $headers = "From: The Handler Library<capstonelibraryproject@gmail.com>\r\n";
  $headers .= "Reply-To: capstonelibraryproject@gmail.com\r\n";
  $headers .= "Content-type: text/html\r\n";

  //php mail function to send the above text
  mail($to, $subject, $message, $headers);

  //Return user to page if the process successfully completes.
  header("Location: resetpasswordform.php?reset=success");
} else {
  header("Location: signup.php");
  exit();
}