<?php
    include_once 'header.php';
?>
 <link href="style.css" rel="stylesheet" type="text/css">
            <h1>Handler Library</h1>
            <h3>Read Books and Make Friends</h3>
            
            <div class="buttons">
                    <?php
                if(isset($_SESSION["useruid"])){
                    echo "<p>You are signed in, " . $_SESSION["useruid"]. "</p>" ;
                   
                }
                
                ?>
                <div class="btn1">
                  <?php
                if(isset($_SESSION["useruid"])){
                    echo "<li><a href='store.php'>Search for books</a></li>";
                  
                }
                else{
                    echo "<li><a href='signup.php'>Signup to create an account</a></li>";
                    
                    }
                ?>
                </div>
                
                <div class="btn2">
                  <?php
                if(isset($_SESSION["useruid"])){
                 echo "<li><a href='message.php'>Chat with friends</a></li>";

                }
                else{
                    echo "<li><a href='login.php'>Login to search our inventory</a></li>";
                    
                    }
                ?>
                </div>
                
            </div>
 <?php
    include_once 'footer.php';
?>