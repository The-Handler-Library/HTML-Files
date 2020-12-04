<?php
	include_once "header.php";

	require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $username = $_SESSION['useruid'];
    $Users = userlist($conn, $username)
?>
<style>
    .container a{
        font-size:152%;
        background: linear-gradient(45deg, grey, darkgray);
        opacity: 0.90;
        filter: alpha(opacity=40);
        margin-bottom: 10%;
        margin-top: 10%;
        border-right-width: 2em;
        border: 1px solid  darkslategrey;
        margin: 10em;
        line-height:1.5em;
        width: 50%;
        height: 10%;
    }
</style>
			<h2 style="color: lightgrey;">Members</h2>
			<div  class="container">
				<?php
				foreach ($Users as $user) {
					echo "<li><a href='send-message.php?receiver=".$user['usersId']."'>".$user['usersName']."</a></li>";
				}
				?>
			</div>