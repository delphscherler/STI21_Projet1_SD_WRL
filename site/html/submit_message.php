<?php  



$recipient=$_POST["recipient"];         //receiving recipient field value in $name variable  

$subject=$_POST["subject"];             //receiving subject field value in $password variable  

$message_body= $_POST["message_body"];  //receiving message_body field value in $password variable 



//Message confirmation

echo "Message confirmation :"

echo "Recipient: $recipient";  

echo "Subject: $subject";

echo "Message: $message_body";

echo "Thank you for submitting"



//Saving the message in the database



$formatted_time = date('Y-m-d H:i:s', $m['time']);

$file_db->exec("INSERT INTO messages (title, message, time) 

        VALUES ('{$m['title']}', '{$m['message']}', '{$formatted_time}')");




?>  