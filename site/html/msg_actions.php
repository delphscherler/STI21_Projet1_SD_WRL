<?php

	require('connexion.php');


	if(ISSET($_POST['read'])) {
		header("Location: show_message.php");				
	}
	if(ISSET($_POST['answer'])) {
		$sender = $_POST['sender'];
		$subject = $_POST['subject'];
		header("Location:new_message.php?sender=$sender&subject=$subject");					
	}			
	
	if(ISSET($_POST['delete'])) {	
		header("Location: inbox.php"); //stay in inbox
		$del = "DELETE FROM messages WHERE sender='".$_POST['sender']."' AND date='".$_POST['date']."' AND subject='".$_POST['subject']."'";		
		$file_db->exec($del);
	}

	// Close file db connection
	$file_db = null;	
?>