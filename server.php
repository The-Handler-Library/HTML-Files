<?php
    
session_start();

$username = "";
$email = "";

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'loginsysten') or die ("No connection to database");

if(isset($_POST['reg_user'])){
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

if(empty($username)) {array_push($errors, "Username Required");}
if(empty($email)) {array_push($errors, "Email Required");}
if(empty($password_1)) {array_push($errors, "Password Required");}
if($password_1 != $password_2) {array_push($errors, "Passwords do not match" );}

$user_check_query = "SELECT * FROM user WHERE username = '$username' or '$email' LIMIT 1";

$results = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($results);

if($user) {
    if($user['username'] === $username){array_push($errors, "Username already exists");}
     if($user['email'] === $email){array_push($errors, "Email already exists with another username");}
}
    
if(count($errors) == 0){
    
    $password = md5($password_1); //hashes password
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You're logged in";
    
    header('location: index1.php');
    }

}
//LOGIN LOGIC

if(isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)){
        array_push($errors, "Username required");
        
    }
    
     if(empty($password)){
        array_push($errors, "Password required");
        
  }
}
    if(count($errors) == 0) {
        $password = md5($password);
        
        $query = "SELECT * FROM user WHERE username= '$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        
        if(mysqli_num_rows($results)){
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in successfully";
            header('location: index1.php');
        }else{
            array_push($errors, "Wrong username or password");
        }
    }

?>