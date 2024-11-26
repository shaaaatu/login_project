<?php
require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

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
	$stmt = $pdo->prepare("INSERT INTO session (username, password)
		SELECT ?, ?
		WHERE NOT EXISTS(SELECT username FROM session WHERE username=?)");
	$stmt->execute([$username, $hashed_ps, $username]);
	if ($stmt->rowCount() > 0)
	{
		echo json_encode([
			"success" => true,
		]);
	}
	else
	{
		echo json_encode([
				"success" => false,
			]);
	}
}
catch (PDOException $e)
{
	echo json_encode([
		"success" => false,
		"error" => $e->getMessage()
	]);
}
?>
