<?php

	// Google analytics
	include_once("analyticstracking.php");

	require_once('connectvars.php');

	if ($_POST['submit']) {
		if ($_POST['message']) {
			// Connect to the database 
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
			$message = mysqli_real_escape_string($dbc, trim($_POST['message']));
			$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
			
			$query = "INSERT INTO suggestion (name, datetime, suggestion, email) VALUES ('$name', now(), '$message', '$email')";
			mysqli_query($dbc, $query) or die (mysqli_error($dbc));
			$msg = "Thank you, your suggestion is sent successfully!";
			echo '<script>window.location.href = "index.php?url=index.php&flag=success&msg='.$msg.'"</script>';
		} else {
			$msg = "Error, please include a message in your suggestion.";
			echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
		}
		
		// Sending email
		// $to = ADMIN_EMAIL; 
		$subject = "Terra Rooms Suggestion (From: $name)";

		// $headers .= "MIME-Version: 1.0\r\n";
		// $headers .= "Content-type: text/html\r\n";
		// $headers = 'From: ' . $email . "\r\n" .
		// 'Reply-To: '. ADMIN_EMAIL . "\r\n" .
		// 'X-Mailer: PHP/' . phpversion();

		// mail($to, $subject, $message, $headers);
		
		$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
				$headers .= 'From: ' . ADMIN_EMAIL . "\r\n";
				$headers .= 'Reply-To: '. ADMIN_EMAIL . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		mail($email, $subject, $message, $headers);
	}
	
