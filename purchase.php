<?php
  include 'connectdb.php';

  //connect to database
  connect_sql();
  $conn = connect_sql();

  //variables
  $purch_date = $purch_location = $auction = $make = $model = $year = $color = "";
  $miles = $condition = $style = $interior_color = $book_price = $price_paid = "";
  $issue_log = $repair_cost = "";

  if (isset($_POST['purch_date'])) $purch_date = $_POST['purch_date'];
  if (isset($_POST['purch_location'])) $purch_location = $_POST['purch_location'];
  if (isset($_POST['auction'])) $auction = $_POST['auction'];

  if (isset($_POST['make'])) $make = $_POST['make'];
  if (isset($_POST['model'])) $model = $_POST['model'];
  if (isset($_POST['v_year'])) $year = $_POST['v_year'];
  if (isset($_POST['color'])) $color = $_POST['color'];
  if (isset($_POST['v_style'])) $style = $_POST['v_style'];

  if (isset($_POST['miles'])) $miles = $_POST['miles'];
  if (isset($_POST['v_condition'])) $condition = $_POST['v_condition'];
  if (isset($_POST['interior_color'])) $interior_color = $_POST['interior_color'];
  if (isset($_POST['book_price'])) $book_price = $_POST['book_price'];
  if (isset($_POST['price_paid'])) $price_paid = $_POST['price_paid'];
  if (isset($_POST['issue_log'])) $issue_log = $_POST['issue_log'];
  if (isset($_POST['repair_cost'])) $repair_cost = $_POST['repair_cost'];
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
