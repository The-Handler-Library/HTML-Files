<?php
include('classes/DB.php');
require_once('header.php');
require_once('functions.inc.php');


if(isset($_POST['send'])){

    //if(DB::query('SELECT usersId FROM users WHERE usersId=:receiver', array(':receiver'=>$_GET['receiver']))) {

        DB::query('INSERT INTO messages (body, sender, receiver, red) VALUES (:body, :sender, :receiver, 0)', array(':body'=>$_POST['body'], ':sender'=>$_SESSION["userid"], ':receiver'=>htmlspecialchars($_GET['receiver'])));
        echo "Message Sent!";
    /*} else {
        die('Invalid ID!');
    }*/
}
 ?>
<h1>Send a Messsage</h1>
<form action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
    <textarea name="body" rows="8" cols="80"></textarea>
    <input type="submit" name="send" value="Send Message">
</form>
