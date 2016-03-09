<?php
	session_start();

	// If the session vars aren't set, try to set them with a cookie
	if (!isset($_SESSION['refreshFreq'])) {
		if (isset($_COOKIE['refreshFreq'])) {
			$_SESSION['refreshFreq'] = $_COOKIE['refreshFreq'];
		}
	}
?>
