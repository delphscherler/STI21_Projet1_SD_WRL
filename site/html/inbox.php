<?php
	session_start();
	
	//Control if user is logged in
	if(!isset($_SESSION['uid'])){
	   header("Location:index.php");
	}
	
	// Logout and close session
	if(ISSET($_POST['logout'])){
		session_unset();
		session_destroy();
		header('Location: index.php');
	}
	
	//New message
	if(ISSET($_POST['new'])) {
		header("Location: new_message.php");
	}
	
	//Administration
	if(ISSET($_POST['admin'])) {
		header("Location: administration.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
    </head>
<body>
    <h1 class="text-primary">Inbox</h1>
	<?php
		$user = $_SESSION['uid'];
		echo "<h2 class=\"text-primary\">Hello $user!</h2>";
	?>
	<hr style="border-top:1px dotted #ccc;"/>
	<form method="POST">
		<button name="new" class="btn btn-outline-primary">New message</button>
		<button name="admin" class="btn btn-outline-info">Administration</button>
        <a href="modify_passwd.php" class="btn btn-outline-info">Change my password</a>
		<button name="logout" class="btn btn-outline-danger">Log out</button>
	</form>
	<hr style="border-top:1px dotted #ccc;"/>
	<table class="table table-hover">
		<thead>
			<tr class="table-primary">
				<th>Sender</th>
				<th>Date</th>
				<th>Subject</th>
				<th>Actions</th>				
			</tr>
		</thead>
		<tbody>
		<tr>
			<?php 			
			   require('connexion.php');

				//Select message for the current user
				$uname=$_SESSION["username"];				
				$sql = "SELECT * FROM messages WHERE receiver='".$uname."' ORDER BY date DESC";
								   
			    foreach  ($file_db->query($sql) as $row) {					
					$sender = $row['sender'];
					$date = $row['date'];
					$subject = $row['subject'];
					
					echo "<form method=\"POST\" action=\"msg_actions.php\">";
					echo "<tr>";
					echo "<td>$sender</td>";
					echo "<input type=\"hidden\" name=\"sender\" value=\"$sender\"/>"; 
					echo "<td>$date</td>";
					echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>";
					echo "<td>$subject</td>";	
					echo "<input type=\"hidden\" name=\"subject\" value=\"$subject\"/>";
					
					//Actions buttons					
					echo "<td><button name=\"read\" class=\"btn btn-primary\">Read</button>";					
					echo "<button name=\"answer\" class=\"btn btn-info\">Answer</button>";	
					echo "<button name=\"delete\" class=\"btn btn-danger\">Delete</button></td>";	
					echo "</tr>";
					echo "</form>";									
				}					

				// Close file db connection
				$file_db = null;					
			?>			
		</tr>			
		</tbody>
</table>	
</body>		
</html>