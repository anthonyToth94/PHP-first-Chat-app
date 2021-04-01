<?php

$message = new Message();
$msg = '';

if(isset($_POST['sendMessage']))
{
	if(isset($_SESSION['uname']))
	{
		if(isset($_SESSION['rName']))
		{
			if(empty($_POST['textBox']))
			{
				echo "<script>alert('Please write something..')</script>";
			}
			else
			{
				$msg = htmlspecialchars($_POST['textBox']);
				$message->setMessage($msg);
				$message->setSender($_SESSION['uname']);
				$message->setReceiver($_SESSION['rName']);
				if($message->writeMessage() == true)
				{		
					$msg = '';
                    //$_SESSION['rName'] = $_GET['name'];
                  	$message->setSender($_SESSION['uname']);
                  	$message->setReceiver($_SESSION['rName']);
                  	$message->selectMessage();
                }
			}
		}
		else
		{
			echo "<script>alert('Who do you want to send?')</script>";
		}

	}
	else
	{
		echo "<script>alert('You are offline!')</script>";
	}
}


?>