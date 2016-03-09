<?php

	// Google analytics
	include_once("analyticstracking.php");

	require_once('connectvars.php');

	if ($_POST['submit']) {
		if ($_POST['email']) {
			if ($_POST['name']) {
				// Connect to the database 
				$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				
				$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
				$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
				
				// Check email not already in list
				$query = "SELECT email FROM gift_code_email_list WHERE email='$email'";
				$result = mysqli_query($dbc, $query) or die (mysqli_error($dbc));
				while ($row=mysqli_fetch_array($result)) {
						$data[] = $row;
				}
				
				if ($data == true) {
					$msg = "Error, $email is already in the subscription list.";
					echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
				} else {
					// Insert email into subscription list
					$query = "INSERT INTO gift_code_email_list (name, datetime, email) VALUES ('$name', now(), '$email')";
					mysqli_query($dbc, $query) or die (mysqli_error($dbc));
				
					$msg = "Thank you, your email is added to the list successfully!";
					echo '<script>window.location.href = "index.php?url=index.php&flag=success&msg='.$msg.'"</script>';
				}
			} else {
				$msg = "Error, please enter your name.";
				echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
			}
		} else {
			$msg = "Error, please enter your email.";
			echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
		}
	}
	
