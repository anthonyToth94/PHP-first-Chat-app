<?php 

$user = new User();

$regE = ['err1' => '', 'err2' => '', 'err3' => '','err4' => '', 'err5' =>'' ,'err6' => ''];
$uname = $uemail = $upass = '';
$registerSuccess = '';

	if(isset($_POST['register']))
	{
		$uname = htmlspecialchars($_POST['uname']);
		$uemail = htmlspecialchars($_POST['uemail']);
		$upass = htmlspecialchars($_POST['upass']);

		if(!empty($_POST['uname']) && !empty($_POST['uemail']) 
		&& !empty($_POST['upass']) && !empty($_POST['upass2']))
		{
			if($user->setUsername($uname) == false)
			{
				$regE['err5'] = 'Incorrect username';
			}
			else
			{
				if($user->setEmail($uemail) == false)
				{
					$regE['err6'] = 'Incorrect email';
				}	
				else
				{
					if(empty($_POST['ugender']))
					{
						$regE['err4'] = 'Please select Gender';	
					}
					else
					{
						$ugender =  htmlspecialchars($_POST['ugender']);
						$ucountry = htmlspecialchars($_POST['ucountry']);
						$user->setGender($ugender);
						$user->setCountry($ucountry);

						if($_POST['upass'] != $_POST['upass2'])
						{
							$regE['err2'] = 'The password is incorrect';
						}
						else
						{
							$user->setPassword(sha1($upass));	
							if($user->register() == true)
							{
								$registerSuccess = 'Successfull';
								$uname = $uemail = $upass = '';
								header('location:index.php');
							}
							else
							{
								$regE['err3'] = 'This username or email is already in use';
							}
							/* print_r($user); */
						}
						
					}
				} 
			}
		
		}
		else
		{
			$regE['err1'] = 'Please fill the form';
		}
	}
?>
