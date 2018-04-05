<?php
  include 'connectdb.php';

  //connect to database
  connect_sql();
  $conn = connect_sql();

  //variables
  $purch_date = $purch_location = $auction = $make = $model = $year = $color = "";
  $miles = $condition = $style = $interior_color = $book_price = $price_paid = "";
  $issue_log = $repair_cost = "";

  if (isset($_POST['purch_date'])) $purch_date = mysqli_real_escape_string($_POST['purch_date']);
  if (isset($_POST['purch_location'])) $purch_location = mysqli_real_escape_string($_POST['purch_location']);
  if (isset($_POST['auction'])) $auction = mysqli_real_escape_string($_POST['auction']);

  if (isset($_POST['make'])) $make = mysqli_real_escape_string($_POST['make']);
  if (isset($_POST['model'])) $model = mysqli_real_escape_string($_POST['model']);
  if (isset($_POST['v_year'])) $year = mysqli_real_escape_string($_POST['v_year']);
  if (isset($_POST['color'])) $color = mysqli_real_escape_string($_POST['color']);
  if (isset($_POST['v_style'])) $style = mysqli_real_escape_string($_POST['v_style']);

  if (isset($_POST['miles'])) $miles = mysqli_real_escape_string($_POST['miles']);
  if (isset($_POST['v_condition'])) $condition = mysqli_real_escape_string($_POST['v_condition']);
  if (isset($_POST['interior_color'])) $interior_color = mysqli_real_escape_string($_POST['interior_color']);
  if (isset($_POST['book_price'])) $book_price = mysqli_real_escape_string($_POST['book_price']);
  if (isset($_POST['price_paid'])) $price_paid = mysqli_real_escape_string($_POST['price_paid']);
  if (isset($_POST['issue_log'])) $issue_log = mysqli_real_escape_string($_POST['issue_log']);
  if (isset($_POST['repair_cost'])) $repair_cost = mysqli_real_escape_string($_POST['repair_cost']);
  $customer_id = "NULL";
  $vehicle_id = "V-000000001";

  if (isset($_POST['purchase_submit']))
  {
    $sql = "INSERT INTO vehicle (vehicle_id, customer_id, make, model, v_year, color, miles, v_condition, repair_cost, book_price,
    issue_log, sales_price, style, interior_color) VALUES ('$vehicle_id', '$customer_id', '$make', '$model', '$year', '$color',
    '$miles', '$condition', '$repair_cost', '$book_price', '$issue_log', '$price_paid', '$style', '$interior_color')";

  	if ($conn->query($sql) === TRUE){
      header('Location: ../purchase_form');
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die();
    }

    $conn->close();
  }
 ?>
