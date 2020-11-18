<?php
	include_once "header.php";

	require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $username = $_SESSION['useruid'];
    $Users = userlist($conn, $username)
?>
			<h2>Members</h2>
			<div class="container">
				<?php
				foreach ($Users as $user) {
					echo "<li><a href='send-message.php?receiver=".$user['usersId']."'>".$user['usersName']."</a></li>";
				}
				?>
			</div>
