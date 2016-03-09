<?php
	// Connect to the database 
	require_once('connectvars.php');
	
	function getList () {
		$rooms = array();
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 	
		// Retrieve room info from database
		$query = "SELECT * FROM rooms where datetime >= DATE_SUB(now(), INTERVAL 15 MINUTE) ORDER BY datetime ASC";
		$data = mysqli_query($dbc, $query) or die (mysqli_error($dbc));
		while ($rows = mysqli_fetch_array($data)) {
			global $rooms;
			$rooms[] = $rows;
		}   
		
		return ($rooms);
	}
