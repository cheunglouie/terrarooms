<?php
	include_once("functions.php");
	$rooms = array();
	$rooms = getList();
	
	$i=0;
	// Display all room
	foreach ($rooms as $room) {
		$room_num = $room['room_num'];
		$room_type = $room['room_type'];
		$note = $room['note'];
		
		echo '
		<a class="list-group-item" >
			<h4 class="list-group-item-heading" id="room_num' .$i. '" ><p>'.$room_num." - " .$room_type.'</p></h4>
			<p class="list-group-item-text" id="note' .$i. '" ><p>'.$note.'</p></p>
		</a>
		';
		$i++;
	}
?>