<?php

// Try to connect to DB
$dsn = 'mysql:host='.$config['DB_host'].';dbname='.$config['DB_database'].';charset=utf8';

// Try to instanciate new PDO object
try {
	$pdo = new PDO($dsn, $config['DB_username'],$config['DB_password']);
}
// Catch errors if any
catch(Exception $e) {
	echo 'Command failed<br>';
	// Show error message
	echo $e->getMessage();
	exit;
}

?>