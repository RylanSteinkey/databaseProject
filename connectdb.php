<?php
function connect_sql(){
	$conn = new mysqli("127.0.0.1", "root", "Catheriner#12", "dms_db");
	if ($conn->error){
		die("Error: " . $conn->error);
	}

	return $conn;
}
 ?>
