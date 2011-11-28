<?php
if (empty($_SESSION['username']) && !isset ($_COOKIE[ini_get('session.name')])) {
    session_start();
}
$redirect_pauseTime = 0;
if(empty($_SESSION['username'])) {
	print("Not logged in. Please click <a href=\"login.html\">here</a> to log in.");
	die();
}
	
?>
