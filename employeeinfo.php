<?php
include 'connectdb.php';

$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT first_name, last_name FROM employee WHERE emp_id = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
    echo "First Name: " . $row['first_name'] . " Last Name: " . $row['last_name'] . " Commission Percentage (%): <input type='number' name=\"rep_commission\">;
  }
} else {
echo $conn->error;
}

$conn->close();
?>
