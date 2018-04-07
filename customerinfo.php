<?php
include 'connectdb.php';


$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT * FROM customer WHERE customer_id = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
    echo "Customer ID: " . $row['customer_id'] . "Name: " . $row['first_name'] . " " . $row['last_name']. "Phone: " . $row['phone'] . "Email: " . $row['email']
    . "<br> Address: " . $row['address'];
  }
} else {
echo $conn->error;
}

$conn->close();
?>
