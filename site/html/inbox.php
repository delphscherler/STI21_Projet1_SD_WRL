<?php
	session_start();
	
	//Control if user is logged in
	if(!isset($_SESSION['username'])){
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
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
<body>
    <h1 class="text-primary">Inbox</h1>
	<hr style="border-top:1px dotted #ccc;"/>
	<form method="POST">
		<button name="new" class="btn btn-outline-primary">New message</button>
		<button name="admin" class="btn btn-outline-info">Administration</button>
		<button name="logout" class="btn btn-outline-danger">Log out</button>
	</form>
	<hr style="border-top:1px dotted #ccc;"/>
	<table class="table table-hover">
		<thead>
			<tr class="table-primary">
				<th>Sender</th>
				<th>Date</th>
				<th>Subject</th>
				<th colspan="3">Actions</th>				
			</tr>
		</thead>
		<tbody>
		<tr>
			<?php 			
				
				//echo "Logged in : " . $_SESSION["username"] . ".<br>";
				
				// Create (connect to) SQLite database in file
				$db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
				// Set errormode to exceptions
				$db->setAttribute(PDO::ATTR_ERRMODE, 
										PDO::ERRMODE_EXCEPTION); 

				if(!$db){
					echo $db->lastErrorMsg();
					} else {
				   // echo "Opened database successfully\n";
				 }
				$uname=$_SESSION["username"];
				
				$sql = "SELECT * FROM messages WHERE receiver='".$uname."'";
								   
			    foreach  ($db->query($sql) as $row) {					
					$sender = $row['sender'];
					$date = $row['date'];
					$subject = $row['subject'];
					
					echo "<td>$sender</td>";
					echo "<td>$date</td>";
					echo "<td>$subject</td>";
					echo "<form method=\"POST\">";
					echo "<td><button name=\"read\" class=\"btn btn-primary\">Read</button></td>";
					echo "<td><button name=\"answer\" class=\"btn btn-info\">Answer</button></td>";	
					echo "<td><button name=\"delete\" class=\"btn btn-danger\">Delete</button></td>";	
					echo "</form>";
				}

				if(ISSET($_POST['read'])) {
					header("Location: show_message.php");				
				}
				if(ISSET($_POST['answer'])) {
					header("Location: new_message.php");				
				}
				if(ISSET($_POST['delete'])) {
					//TODO sql request to delete the message
				}
				

				// Close file db connection
				$db = null;					
			?>			
		</tr>			
		</tbody>
</table>	
</body>		
</html>