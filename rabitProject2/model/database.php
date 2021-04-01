<?php

class Database
{
	public static $host = 'localhost';
	public static $dbName = 'rabit';
	public static $userName = 'root';
	public static $password = '';

	private static function Connect()
	{
      $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8mb4", self::$userName, self::$password);
      return $pdo;
	}

	public static function Query($sql, $params = array())
	{

		$query = self::connect()->prepare($sql);
		$query->execute($params);
		$results = $query->fetchAll(PDO::FETCH_NUM);
		return $results;
	}

	public static function Fetch($sql, $param = array())
	{
		$query = self::connect()->prepare($sql);
		$query->execute($param);
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function QueryFetch($sql, $params = array())
	{
		$array = array();
		$object = ['id' => '', 'title' => '', 'name' => ''];

		$query = self::connect()->prepare($sql);
		$query->execute($params);
		$results = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($results as $row)
		{
			$object['id'] = $row['id'];
			$object['title'] = $row['title'];

			//params
			$id = [ "id"=> $row['userid']];	
			$result = self::Fetch("SELECT name FROM users WHERE id = :id", $id);

			$object['name'] = $result['name'];

			array_push($array, $object);

		}

		return $array;
		
	}

}

?>
