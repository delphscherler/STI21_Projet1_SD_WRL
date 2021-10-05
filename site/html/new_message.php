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
        <div class="col-md-6">
            <form action="submit_message.php" method="POST">
                <div class="form-group"> <!-- Destinataire! -->
                    <label>Receiver</label>
                    <input type="text" name="recipient" class="form-control" required="required"/>
                </div>
                <div class="form-group"> <!-- Sujet! -->
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required="required"/>
                </div>
                <div class="form-group"> <!-- Corps du message! -->
                    <label>Message</label> 
                    <textarea name="message_body" rows="5" cols="40"  class="form-control"></textarea>
                </div> 
                <div class="form-group">
                    <input type="submit" />
                </div> 
            </form>
        </div>
    </body>		
</html>