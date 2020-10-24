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
                <button onclick="window.location.href='login.php';" class="btn btn1">Search For Books</button>
                <button onclick="window.location.href='login.php';" class="btn btn2">Chat With Friends</button>
            </div>
 <?php
    include_once 'footer.php';
?>