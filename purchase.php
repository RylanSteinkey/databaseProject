<?php
  include 'connectdb.php';

  connect_sql();
  $conn = connect_sql();

  if (isset($_POST['purchase_submit']))
  {
      $make = mysqli_real_escape_string($conn, $_POST['make']);
      $model = mysqli_real_escape_string($conn, $_POST['model']);
      $v_year = mysqli_real_escape_string($conn, $_POST['v_year']);
      $color = mysqli_real_escape_string($conn, $_POST['color']);
      $style = mysqli_real_escape_string($conn, $_POST['style']);
      $interior_color = mysqli_real_escape_string($conn, $_POST['interior_color']);
      $miles = mysqli_real_escape_string($conn, $_POST['miles']);
      $v_condition = mysqli_real_escape_string($conn, $_POST['v_condition']);
      $repair_cost = mysqli_real_escape_string($conn, $_POST['repair_cost']);
      $book_price = mysqli_real_escape_string($conn, $_POST['book_price']);
      $issue_log = mysqli_real_escape_string($conn, $_POST['issue_log']);

      $markup = 30;
      $sale_price = $price_paid *($markup/100);

      $customer_id = 0;
      $sql_vehicle = "INSERT INTO vehicle (customer_id, make, model, v_year, color, style,
      interior_color, miles, v_condition, repair_cost, book_price, sale_price, issue_log)
      VALUES('$customer_id', '$make', '$model', '$v_year',
      '$color', '$style', '$interior_color', '$miles', '$v_condition', '$repair_cost', '$book_price', '$sale_price', '$issue_log')";
      if ($conn->query($sql_vehicle) === TRUE)
      {
        $dealer_id = mysqli_real_escape_string($conn, $_POST['dealer_id']);
        $purch_date = mysqli_real_escape_string($conn, $_POST['purch_date']);
        $purch_location = mysqli_real_escape_string($conn, $_POST['purch_location']);
        $auction = mysqli_real_escape_string($conn, $_POST['auction']);

        $sql = "INSERT INTO car_purchase (dealer_id, emp_id, vehicle_id, price_paid, purch_date, auction, notes)
        VALUES ('$dealer_id','$emp_id', '$vehicle_id', '$price_paid', '$purch_date', '$auction', '$issue_log')";

        if ($conn->query($sql) === TRUE)
        {
          header('Location: ../purchase_form');
          exit;
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          die();
        }
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
      }
      $conn->close();
  }
 ?>
