<?php
$host = 'localhost';
$dbname = 'kensyuu';
$db_user = 'test';
$db_password = 'test';

try
{
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_password);
	$result = $pdo->query("SHOW TABLES LIKE 'session'");

	if ($result->rowCount() > 0)
	{
		$query = "TRUNCATE session";
		$pdo->exec($query);
		echo "clear session table";
	}
	else
	{
		echo "session table is not exist";
	}
}
catch (PDOException $e)
{
	die("接続失敗: " . $e->getMessage());
}
?>
