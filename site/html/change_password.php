<?php

//echo "Your password has been successfully updated";

    require('connexion.php');

	if(ISSET($_POST['update'])) {	
	//	header("Location: administration.php"); //stay in inbox
		$upd = "UPDATE users SET password='".$_POST['new_password']."' WHERE username='".$_SESSION['username']."'";		
		$file_db->exec($upd);
		echo '<script type ="text/JavaScript">';  
		echo 'alert("Password successfully updated")';  
		echo '</script>';	
		
	}

	// Close file db connection
	$file_db = null;	
?>