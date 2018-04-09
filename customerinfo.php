<?php
include 'connectdb.php';


$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT * FROM customer WHERE customer_id = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
		echo "Customer ID: <input type='text' name='customer_id' value='" . $row['customer_id'] . "' readonly> ";
		echo "First Name: <input type='text' name='first_name' value='" . $row['first_name'] . "' readonly> ";
		echo "Last Name: <input type='text' name='last_name' value='" . $row['last_name'] . "' readonly> <br>";
		echo "Phone Number: <input type='text' name='phone' value='" . $row['phone'] . "' readonly> ";
		echo "Email: <input type='text' name='email' value='" . $row['email'] . "' readonly> ";
		echo "Address: <input type='text' name='address' value='" . $row['address'] . "' readonly> ";
  }
} else {
echo $conn->error;
}

$conn->close();
?>
