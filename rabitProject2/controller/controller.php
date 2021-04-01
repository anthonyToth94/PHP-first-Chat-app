<?php

require_once('./model/database.php'); 

class Controller extends Database
{
	public static function createView($viewName, $data = array())
	{
		require_once('./views/'.$viewName.'.php');
	}
}


?>