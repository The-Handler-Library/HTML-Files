<style>
     .wrapper{
    
         font-family: "lato";
         color: white;
         text-align: center;
         display: block;
      margin-left:auto;
      margin-right:auto;
    
    
    }
</style>
<?php
include('classes/DB.php');
require_once('header.php');
$userid = $_SESSION['userid'];

if (isset($_GET['mid'])) {
    $message = DB::query('SELECT * FROM messages WHERE id=:mid AND receiver=:receiver OR sender=:sender', array(':mid'=>$_GET['mid'], ':receiver'=>$userid, ':sender'=>$userid))[0];
    echo '<h5>Reply</h5>';
    
    

    if ($message['sender'] == $userid) {
        $id = $message['receiver'];
    } else {
        $id = $message['sender'];
    }
    DB::query('UPDATE messages SET red=1 WHERE id=:mid', array(':mid'=>$_GET['mid']));
    ?>
    <form action="send-message.php?receiver=<?php echo $id; ?>" method="post">
        <textarea name="body" rows="8" cols="80"></textarea>
        <input style="  background-color: cyan;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 25%;
  opacity: 0.9;
     display: block;
      margin-left:auto;
      margin-right:auto;"
    type="submit" name="send" value="Send Message">
    </form>
    <?php
} else {

 ?>
<h5>My Messages</h5>


<?php
$messages = DB::query('SELECT messages.*, users.usersName FROM messages, users WHERE (messages.receiver=:receiver OR messages.sender=:sender) AND users.usersId = messages.sender', array(':receiver'=>$userid, ':sender'=>$userid));

foreach ($messages as $message) { 

  
        $m = $message['body'];
    

    if ($message['red'] == 0) {
      echo "<a href='my-messages.php?mid=".$message['id']."'><strong style =' background: grey; color:cyan;'>".$m."</strong></a> sent by ".$message['usersName']. '<hr />';

    } else {
      echo "<a href='my-messages.php?mid=".$message['id']."'>".$m."</a> sent by ".$message['usersName'].'<hr />';

    }


}

}
?>
