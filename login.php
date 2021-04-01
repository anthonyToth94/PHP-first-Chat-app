<?php

$user = new User(); 

$regL = ['err1' => '', 'err2' => '', 'err3' => ''];
$usernameL = $passwordL = '';
$loginSuccess = '';

	if(isset($_POST['login']))
	{
		$usernameL = htmlspecialchars($_POST['usernameL']);
		$passwordL = htmlspecialchars($_POST['passwordL']);

		if($usernameL == '' || $passwordL == '')
		{
			$regL['err3'] = 'Fill the form';
		}
		else
		{
			if($user->setUsername($usernameL) == false)
			{
				$regL['err1'] = 'Incorrect username';
			}
			else
			{
				$user->setPassword(sha1($passwordL));
				if($user->login() == true)
				{
					$loginSuccess = 'Successfull';
					$usernameL = $passwordL = '';

			        $_SESSION['uname'] = $user->getUsername();
			        header('location:index.php');
				}
				else
				{
					$regL['err2'] = 'Incorrect username or password';
				}
				/*print_r($_SESSION['uname']);*/
				/* print_r($user); */
			}
		}
		

	}
?>