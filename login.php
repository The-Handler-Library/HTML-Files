<?php
    include_once 'header.php';
?>
           
       
            <section class="signup-form">
                    <h2>Log in</h2>
                        <form action="login.inc.php" method="post">
                            
                        <input type="text" name="uid" placeholder="Username/Email...">
                            <input type="password" name="pwd" placeholder="Password..">
                          
                            <button type= "submit" name="submit">Log in</button>
                        </form>
                 <a href="resetpasswordform.php">Forgot your password?</a>
                           <?php
    if(isset($_GET["error"])){
        
        if($_GET["error"]== "emptyinput"){
            echo "<p>Fill in all fields.</p>";
            
        }
        else if ($_GET["error"] == "wronguid"){
            echo "<p>Incorrect login information</p>";
        }
         
    }

?>
            </section>

