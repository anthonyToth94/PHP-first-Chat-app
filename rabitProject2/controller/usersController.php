<?php

require_once('./controller/controller.php');

class UsersController extends Controller{

	public static function getUsers()
	{
		return self::Query("SELECT * FROM users");
	}
}

?>