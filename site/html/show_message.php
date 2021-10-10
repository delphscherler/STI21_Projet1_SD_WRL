<?php
	session_start();
	
	//Control if user is logged in
	if(!isset($_SESSION['username'])){
	   header("Location:index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
    <body>
    <div class="col-md-6 well">
        <h1 class="text-primary">Message</h1>		
        <hr style="border-top:1px dotted #ccc;"/>
        <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
		<hr style="border-top:1px dotted #ccc;"/>
		<!-- Actions buttons -->
		<form method="POST" action="msg_actions.php">				 		
				<button name="answer" class="btn btn-info">Answer</button>
				<button name="delete" class="btn btn-danger">Delete</button>			
			
		
		<!-- Display message -->
		<?php 			
			require('connexion.php');			
			$sql = "SELECT * FROM messages WHERE sender='".$_GET['sender']."' AND date='".$_GET['date']."' AND subject='".$_GET['subject']."'";
			
			foreach  ($file_db->query($sql) as $row) {					
					$sender = $row['sender'];
					$date = $row['date'];
					$subject = $row['subject'];
					$message = $row['message'];
			}
			
			echo "<table class=\"table table-hover\">";
			echo "<tr>";
			echo "<td>Sender : </td><td>$sender</td>";
			echo "<input type=\"hidden\" name=\"sender\" value=\"$sender\"/>"; 
			echo "</tr>";
			echo "<tr>";
			echo "<td>Date : </td><td>$date</td>";
			echo "<input type=\"hidden\" name=\"date\" value=\"$date\"/>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Subject : </td><td>$subject</td>";
			echo "<input type=\"hidden\" name=\"subject\" value=\"$subject\"/>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Message : </td><td>$message</td>";			
			echo "</tr>";
			echo "</table>";
			
			
			// Close file db connection
			$file_db = null;   
		?>		
		</form>	
    </body>		
</html>