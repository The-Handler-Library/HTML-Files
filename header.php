<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=viewport content = "width=device-width, initial-scale=1">
    <title> Home Page </title>
    <link href="/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    
    <div class= "wrapper">
        
        <nav class= "navbar">
            
            <img class="logo" src="images/logo2.jpeg">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                
                <?php
                if(isset($_SESSION["useruid"])){
                    echo "<li><a href='profile.php'>Profile Page</a></li>";
                    echo "<li><a href='friends.php'>Friends</a></li>";
                    echo "<li><a href='logout.inc.php'>Log out</a></li>";
                }
                else{
                    echo "<li><a href='signup.php'>Signup</a></li>";
                    echo "<li><a href='login.php'>LOGIN</a></li>";
                    }
                ?>
                
            </ul>
        </nav>
        <div class="center">