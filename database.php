<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'php_chat';


/* C R E A T E dsl */
$dsl = "mysql:host=localhost;dbname=php_chat";
    /* exception handling */
    try
    {
        $pdo = new PDO($dsl,$dbusername,$dbpassword);
    }
    catch(Exception $ex)
    {
        die('Connection failed '.$ex->getMessage());
    }

?>