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
		<h1 class="text-primary">New Message</h1>
        <hr style="border-top:1px dotted #ccc;"/>
		<button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
		<hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group"> <!-- Destinataire! -->
                    <label>Receiver</label>
					<!-- Retrieve receiver -->
					<?php
						if($_GET){ //if response to a msg
							$sender = $_GET['sender'];						
							echo "<input type=\"text\" name=\"receiver\" class=\"form-control\" required=\"required\" value=\"$sender\">";
						}
						else{							
							echo "<select class=\"form-select\" name=\"receiver\" required=\"required\">";
							require('connexion.php');
							$sql="SELECT * FROM users";
							foreach  ($file_db->query($sql) as $row) {
								$username = $row['username'];						
								echo "<option>$username</option>";
							}
							echo "</select>";
						// Close file db connection
						$file_db = null;
						}
					?>
                </div>
                <div class="form-group"> <!-- Sujet! -->
                    <label>Subject</label>
					<?php
						if($_GET){ //if response to a msg
							$subject = $_GET['subject'];				
							echo "<input type=\"text\" name=\"subject\" class=\"form-control\" required=\"required\" value=\"RE : $subject\">";
						}
						else{
							echo "<input type=\"text\" name=\"subject\" class=\"form-control\" required=\"required\">";
						}
					?>                    
                </div>
                <div class="form-group"> <!-- Corps du message! -->
                    <label>Message</label> 
                    <textarea name="message_body" rows="5" cols="40"  class="form-control"></textarea>
                </div> 
                <div class="form-group">
                    <button name="send" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>Send</button>
                </div> 
            </form>
			<?php include 'submit_message.php'?>
        </div>
    </body>		
</html>