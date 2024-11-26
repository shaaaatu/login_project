<?php
$host = 'localhost';
$dbname = 'kensyuu';
$user = 'test';
$pass = 'test';

try
{
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$result = $pdo->query("SHOW TABLES LIKE 'session'");

	if ($result->rowCount() === 0)
	{
		$createTableQuery = "
			CREATE TABLE session (
				id INT AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(255) NOT NULL,
				password VARCHAR(255) NOT NULL,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)
		";
		$pdo->exec($createTableQuery);
		echo "sessionテーブルが作成されました。";
	}
	else
	{
		echo "sessionテーブルはすでに存在します。";
	}
}
catch (PDOException $e)
{
	echo "エラー: " . $e->getMessage();
}
?>
