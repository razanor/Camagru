<?php

require_once('database.php');

$sql = file_get_contents('Db.sql');
try {
	$dsn = "mysql:host=" . DB_HOST . ";charset=utf8";
	$db = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (\PDOException $e) {
	echo $e->getMessage();
}
$res = $db->query($sql);
if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
}


$dir = '../uploads';

if (is_dir($dir)) {
    $files = glob($dir . '/*'); //get all file names
        foreach($files as $file) {
            if (is_file($file))
            unlink($file); //delete file
        }
	rmdir($dir);
}
mkdir($dir);

echo "
<h4>DB re-created</h4>
<a href='/'>Go to main page!</a>
";
