<?php
require './vendor/autoload.php';

require __DIR__.'/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$host = 'localhost';
$dbname = 'kensyuu';
$user = 'test';
$pass = 'test';

try
{
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}
catch (PDOException $e)
{
	die("DB接続失敗: " . $e->getMessage());
}

$username = $_POST['username'];
$password = $_POST['password'];
$salt = $_ENV['SALT'];

$salt_ps = $password . $salt;
$hashed_ps = hash('sha512', $salt_ps);

try
{
	$stmt = $pdo->prepare("INSERT INTO session (username, password)
		SELECT ?, ?
		WHERE NOT EXISTS(SELECT username FROM session WHERE username=?)");
	$stmt->execute([$username, $hashed_ps, $username]);
	if ($stmt->rowCount() > 0)
	{
		echo "Successfully inserted data";
	}
	else
	{
		echo "username is already in use";
	}
}
catch (PDOException $e)
{
	echo "登録に失敗しました: " . $e->getMessage();
}
?>
