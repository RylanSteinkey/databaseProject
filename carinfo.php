<?php
include 'connectdb.php';


$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT * FROM vehicle WHERE vehicle_id = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
		echo "Vehicle Make: <input type='text' name='make' value='" . $row['make'] . "' readonly> ";
		echo "Vehicle Model: <input type='text' name='model' value='" . $row['model'] . "' readonly> ";
		echo "Vehicle Year: <input type='text' name='v_year' value='" . $row['v_year'] . "' readonly> <br>";
		echo "Vehicle Color: <input type='text' name='color' value='" . $row['color'] . "' readonly>";
		echo "Vehicle Style: <input type='text' name='style' value='" . $row['style'] . "' readonly> ";
		echo "Interior Color: <input type='text' name='interior_color' value='" . $row['interior_color'] . "' readonly> ";
  }
} else {
echo $conn->error;
}

$conn->close();
?>
