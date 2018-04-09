<?php
include 'connectdb.php';

$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT * FROM warranty_type WHERE warranty_code = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
    echo "<td><input type='number' name='warranty_code2' value='" . $row['warranty_code'] . "' readonly></td>";
    echo "<td><input type='date' name='start_date' value='" . $row['start_date'] . "' readonly></td>";
    echo "<td><input type='number' name='length' value='" . $row['length'] . "' readonly></td>";
    echo "<td><input type='number' name='cost' value='" . $row['cost'] . "' readonly></td>";
    echo "<td><input type='number' name='deductible' value='" . $row['deductible'] . "' readonly></td>";
    echo "<td><input type='textarea' name='covered_items' value='" . $row['covered_items'] . "' readonly></td>";
  }
} else {
echo $conn->error;
}

$conn->close();
?>
