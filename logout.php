<?php

if(isset($_POST['logout']))
{
	if(isset($_SESSION['uname']))
	{
		$user->updateOffline($_SESSION['uname']);
		header('location:index.php');
		session_destroy();
	}

}

?>