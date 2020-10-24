<?php
//checks to ensure user signs up correctly and doesn't cheese the URL
if (isset($_POST{'submit'})){
    echo "Welcome";
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
//checks for errors in the inputs

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)!== false){
        header("location: signup.php?error=emptyinput");
        exit();
        
    }
     if (invalidUid($username)!== false){
        header("location: signup.php?error=invaliduid");
        exit();
        
    }
    
     if (invalidEmail($email)!== false){
        header("location: signup.php?error=invalidemail");
        exit();
        
    }
    if (pwdMatch($pwd, $pwdRepeat)!== false){
        header("location: signup.php?error=passwordsdonotmatch");
        exit();
        
    }
    if (uidExists($conn, $username, $email)!== false){
        header("location: signup.php?error=usernameistaken");
        exit();
        
    }
    
    
    createUser($conn, $name, $email, $username, $pwd);
}
//sends user to home if they signed up incorrectly
else{
    header("location: signup.php");
}