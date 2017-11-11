<?php

/* This helps my index.php controller determine which page to load. */
function render($template, $data = array()) {
	$path = __DIR__ . '/../views/' . $template . '.php';
	if (file_exists($path)) {
		extract($data);
		require($path);
	}
}

/* This is used to generate a random code for the user. */
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function redirect($url, $statusCode)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

/* Setting the date & time for EST America. */
date_default_timezone_set("America/Detroit");

?>