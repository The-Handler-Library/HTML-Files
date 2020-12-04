<?php
    include_once 'header.php';
?>
          
           
            <section class="signup-form">
                    <h2>Sign up</h2>
                        <form action="signup.inc.php" method="post">
                            <input type="text" name="name" placeholder="Full name...">
                            <input type="text" name="email" placeholder="Email...">
                            <input type="text" name="uid" placeholder="Username...">
                            <input type="password" name="pwd" placeholder="Password..">
                            <input type="password" name="pwdrepeat" placeholder="Confirm Password...">
                            <button type= "submit" name="submit">Sign Up</button>
                         </form>
                <?php
                if(isset($_GET["newpwd"])){
                    if($_GET["newpwd"] == "passwordupdated"){
                        echo '<p class="signupsuccess">Your password has been reset.</p>';
                    }
                }
                ?>
                <a href="passwordreset.php">Forgot your password?</a>
                
                
          
                
                
                
                
         <?php
              
         if(isset($_GET["error"])){
        
             if($_GET["error"]== "emptyinput"){
            echo "<p>Fill in all fields.</p>";
            
        }
             else if ($_GET["error"] == "invaliduid"){
            echo "<p>Choose a valid username</p>";
        }
             else if ($_GET["error"] == "invalidemail"){
            echo "<p>Choose a valid email</p>";
        }
             else if ($_GET["error"] == "passwordsdonotmatch"){
            echo "<p>Passwords do not match</p>";
        }
             else if ($_GET["error"] == "stmtfailed"){
            echo "<p>Something went wrong, please try again.</p>";
        }
             else if ($_GET["error"] == "usernametaken"){
            echo "<p>Username is already taken.</p>";
        }
             else if ($_GET["error"] == "none"){
            echo "<p>You have successfully signed up.</p>";
        }
    }

?>
            </section>
