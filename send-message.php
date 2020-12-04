<?php
include('classes/DB.php');
require_once('header.php');
require_once('functions.inc.php');


if(isset($_POST['send'])){

    if(DB::query('SELECT usersId FROM users WHERE usersId=:receiver', array(':receiver'=>$_GET['receiver']))) {

        DB::query('INSERT INTO messages (body, sender, receiver, red) VALUES (:body, :sender, :receiver, 0)', array(':body'=>$_POST['body'], ':sender'=>$_SESSION["userid"], ':receiver'=>htmlspecialchars($_GET['receiver'])));
        echo "<p style='color:white; text-align:center; font-family:bebas; '>" . "Message Sent!";  "</p>";
    } else {
        die('Invalid ID!');
    }
}
 ?>
<h5>Send a Message</h5>
<form style = "text-align:center;" action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
    <textarea name="body" rows="8" cols="80"></textarea>
    <input style = "background-color: cyan;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 25%;
        opacity: 0.9;
        display: block;
        margin-left:auto;
        margin-right:auto;" type="submit" name="send" value="Send Message">
</form>
