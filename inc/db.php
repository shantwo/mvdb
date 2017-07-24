<?php

// Try to connect to DB
$dsn = 'mysql:host='.$DB_config['DB_host'].';dbname='.$DB_config['DB_database'].';charset=utf8';

// Try to instanciate new PDO object
try {
	$pdo = new PDO($dsn, $DB_config['DB_username'],$DB_config['DB_password']);
}
// Catch errors if any
catch(Exception $e) {
	echo 'PDO error<br>';
	// Show error message
	echo $e->getMessage();
	exit;
}

?>
