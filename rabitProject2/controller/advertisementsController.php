<?php
require_once('./controller/controller.php');

class advertisementsController extends Controller
{
	public static function getAdvertisements()
	{
		return self::QueryFetch("SELECT * FROM advertisements");
	}
}

?>