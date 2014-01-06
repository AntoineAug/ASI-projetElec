<?php

$message = @file_get_contents(USER_DIRECTORY. '/message.txt');

if(!empty($message))
{
	//echo '<h3>Message</h3>';
	echo '<p>'. nl2br(stripslashes($message)) .'</p>';
}

?>