<?php

// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);

session_start();

require_once __DIR__.'/includes/header.php';
require_once __DIR__.'/helper.php';

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'GET') {
	// generate a token
    generateCSRFToken();
    require_once __DIR__.'/login_form.php';

} elseif ($request_method === 'POST') {
	// handle the form submission
	require_once __DIR__.'/action/login.php';
}

require_once __DIR__.'/includes/footer.php';