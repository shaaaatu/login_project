<?php
require './vendor/autoload.php';

require __DIR__.'/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$host = 'localhost';
$dbname = 'kensyuu';
$db_user = 'test';
$db_pass = 'test';

try
{
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_pass);
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
	$stmt = $pdo->prepare("SELECT username, password FROM session WHERE username=? AND password=?");
	$stmt->execute([$username, $hashed_ps]);
	if ($stmt->rowCount() > 0)
		echo "login with " . "$username";
	else
		echo "id or password is not correct";
}
catch (PDOException $e)
{
	echo "登録に失敗しました: " . $e->getMessage();
}
?>
