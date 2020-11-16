<?php
    include_once 'header.php';
?>
            <h1>Capstone Library</h1>
            
            <div class="container">
                    <?php
                if(isset($_SESSION["useruid"])){
                    echo "<p>You are signed in " . $_SESSION["useruid"]. "</p>" ;
                   
                }
                
                ?>
                 <?php
                if(isset($_SESSION["useruid"])){
                    echo "<li><a href='search.php'>Search for books</a></li>";
                    echo "<li><a href='message.php'>Chat with friends</a></li>";
                }
                else{
                    echo "<li><a href='signup.php'>Signup to create an account</a></li>";
                    echo "<li><a href='login.php'>Login to search our inventory</a></li>";
                    
                    
                    }
                ?>
            </div>
 <?php
    include_once 'footer.php';
?>
