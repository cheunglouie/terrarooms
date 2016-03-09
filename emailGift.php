<?php

// Google analytics
include_once("analyticstracking.php");

require_once('connectvars.php');

if (isset ($_POST['submit'])) {
	if (isset ($_POST['giftCode'])) {
		if (isset ($_POST['giftContent'])) {
			// Connect to the database 
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			$giftContent = mysqli_real_escape_string($dbc, trim($_POST['giftContent']));
			$giftContent = str_replace('\r\n', '<br>', $giftContent);
			$giftCode = mysqli_real_escape_string($dbc, trim($_POST['giftCode']));
			
			// Grab all email from email list
			$query = "SELECT name, email FROM gift_code_email_list";
			$result = mysqli_query($dbc, $query) or die (mysqli_error($dbc));
			while ($row=mysqli_fetch_array($result)) {
				$datas[] = $row;
			}
				
			foreach ($datas as $data) {
				// Sending email
				$name = $data['name'];
				$email = $data['email']; 
				$subject = "Terra Battle Gift Code (brought to you by www.terrarooms.com)";
				$message = "
					<html>
					<body>
						<img src='http://www.perfec.com/terrarooms/images/Peprope-logo.jpg' height='110' width='110'><br>
						Hi $name,<br>
						<br>
						Gift Code:<br>
						<h2><b>$giftCode</b></h2><br>
						Gift Content:<br>
						<h2><b>$giftContent</b></h2><br>
						Enjoy this code from www.terrarooms.com<br>
						Come and join forces with other players in a private room today!<br><br>
						Add <b>do-not-reply@terrarooms.com</b> to your safe email list so you'll never miss a code!<br><br>
						unsubscribe <a href='www.terrarooms.com/unsubscribe.php'>here</a>
					</body>
					</html>
				";
				
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
				$headers .= 'From: ' . ADMIN_EMAIL . "\r\n";
				$headers .= 'Reply-To: '. ADMIN_EMAIL . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				mail($email, $subject, $message, $headers);
			}
			
			echo "Gift code is sent successfully!";
		} else {
			echo "Error, please include gift content";
			// echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
		}
	} else {
		echo "Error, please include gift code";
		// echo '<script>window.location.href = "index.php?url=index.php&flag=fail&msg='.$msg.'"</script>';
	}
} else {
?>
	<form enctype="multipart/form-data" method="post" action="<?php $_SERVER["PHP_SELF"] ?>" >
		<label for="giftCode">Gift Code: </label>
		<input type="text" name="giftCode" id="giftCode" maxlength="16"></input>
		<br><br>
		<label for="giftContent">Gift Content: </label>
		<textarea name="giftContent" id="giftContent" ></textarea>
		<br><br>
		<input type="submit" name="submit" id="submit"></input>
	</form>
<?php
}

