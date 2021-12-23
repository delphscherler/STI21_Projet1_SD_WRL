<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


function changePassword($username, $password){

require('connexion.php');
require('validation.php');

    if(verifyPassword($password)){
                $passwordDb = password_hash($password, PASSWORD_DEFAULT);
                $upd = "UPDATE users SET password='".$passwordDb."' WHERE username='".$username."'";
                $file_db->exec($upd);
                echo '<script type ="text/JavaScript">';
                echo 'alert("Password successfully updated")';
                echo '</script>';
    		}else{
    		    echo "<div class=\"alert alert-dismissible alert-danger\">";
                echo "Password must contain between 8 and 64 characters.";
                echo "</div>";
                exit();
    		}
}

?>