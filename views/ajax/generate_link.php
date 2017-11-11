<?php

/**
* availability.php
*
* This talks to the mySQL database & checks whether the username
* or email is attached to an existing account that has the ability 
* to resell the product.
*
*/

// reminding the server that a session is going on so that
// we can change session variables in this ajax call. 
// session_start();

/* Connecting to the database. */
$dsn = 'mysql:dbname=crosaomy_subscribers;host=localhost';
$user = 'crosaomy_admin';
$password = 'sjbew8==DIT';

try {
	$dbh = new PDO($dsn, $user, $password);
	//$_SESSION['server'] = $dbh;
}
catch (PDOException $e) {
	print 'Connection failed: ' . $e->getMessage();
}

//including the helper functions for generating the random string.
require '../includes/helpers.php';

// set MIME type
header("Content-type: application/json");

/* Creating a JSON object. */
class Result {
	public $download_id;
	public $already_used;
}

$new_result = new Result();

// $input_email = $_GET['email'];
// $input_first = $_GET['first_name'];
// $input_last = $_GET['last_name'];

// checking to make sure the user hasn't already tried to sign-up once before.
// this prevents a form error with mailchimp when people are signing up twice.
$search = $dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `email` = ?");
$search->execute(array($_GET['email']));
$new_result->already_used = $search->fetchColumn();

// $already_registered = "0";

// only adding to the table if they haven't registered before.
if ($new_result->already_used == 0) {
	$download_code = generateRandomString(); // generating a random password.
	// $encrypted_id = password_hash($new_id, PASSWORD_BCRYPT); // encrypting the password.

	// entering the info in the password_request mysql table & constructing a custom url for the user.
	$insert = $dbh->prepare("INSERT INTO `crosaomy_subscribers`.`users` (`user_id` ,`first`, `last`, `email`, `date`, `download_id`, `used`) VALUES (NULL, ?, ?, ?, ?, ?, 0)");
	$insert->execute(array($_GET['first_name'], $_GET['last_name'], $_GET['email'], date("Y-m-d H:i:s"), $download_code));

	$new_result->download_id = $download_code;
	// $new_results->already_used = 0;
}


// output JSON
print(json_encode($new_result));
?>