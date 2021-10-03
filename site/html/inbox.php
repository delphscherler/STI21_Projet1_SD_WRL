<?php
	session_start();
	// Logout and close session
	if(isset($_POST['logout'])) { //NOT OK
		session_unset();
		session_destroy();
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
	<button name="new" class="btn btn-outline-primary" onClick="location.href='new_message.html'">New message</button>
	<button name="admin" class="btn btn-outline-info" onClick="location.href='administration.php'">Administration</button>
	<button name="logout" class="btn btn-outline-danger" onClick="location.href='index.php'">Log out</button>
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
					echo "<td><button name=\"read\" class=\"btn btn-primary\" onClick=\"location.href='show_message.html'\">Read</button></td>";
					echo "<td><button name=\"answer\" class=\"btn btn-info\" onClick=\"location.href='new_message.html'\">Answer</button></td>";	
					echo "<td><button name=\"delete\" class=\"btn btn-danger\">Delete</button></td>";				
				}

				// Close file db connection
				$db = null;					
			?>			
		</tr>			
		</tbody>
</table>	
</body>		
</html>