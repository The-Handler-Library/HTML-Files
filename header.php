<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="icon" href="logo2.jpeg">

    <meta charset="UTF-8">
    
    <meta name=viewport content = "width=device-width, initial-scale=1">
    
    <title> Home Page </title>
    
    <link href="css/style.css" rel="stylesheet" type="text/css">
  


</head>

<body>
    
    <div class= "wrapper">
        
        <nav class= "navbar">
            
            <img class="logo" src="logo2.jpeg">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="library_db.php">Catalog</a></li>
                <?php
                if(isset($_SESSION["useruid"])){
                    echo "<li><a href='friends.php'>Friends</a></li>";
                    echo "<li><a href='store.php'>Store</a></li>";
                    echo "<li><a href='message.php'>Messages</a></li>";
                    echo "<li><a href='logout.inc.php'>Log out</a></li>";
                }
                else{
                    echo "<li><a href='signup.php'>Signup</a></li>";
                    echo "<li><a href='login.php'>LOGIN</a></li>";
                    
                    
                    }
                ?>
               
            </ul>
        </nav>
  