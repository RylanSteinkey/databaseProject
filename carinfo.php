<?php
include 'connectdb.php';


$q = $_GET['q'];

connect_sql();
$conn = connect_sql();

$sql = "SELECT * FROM vehicle WHERE vehicle_id = '".$q."'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
	while ($row = $results->fetch_assoc()){
    echo "Vehicle Make: " . $row['make'] . "Vehicle Model " . $row['model'] . "Vehicle Year: " . $row['v_year'] . "Vehicle Color: " . $row['color']
    . "<br> Vehicle Style: " . $row['style'] . "Interior Color: " . $row['interior_color'];
  }
} else {
echo $conn->error;
}

$conn->close();
?>
