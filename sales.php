<?php
  include 'connectdb.php';

  connect_sql();
  $conn = connect_sql();

  if (isset($_POST['sale_submit']))
  {
      $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
      $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
      $vehicle_id = mysqli_real_escape_string($conn, $_POST['vehicle_id']);
      $date_sold = mysqli_real_escape_string($conn, $_POST['date_sold']);
      $total_due = mysqli_real_escape_string($conn, $_POST['total_due']);
      $down_payment = mysqli_real_escape_string($conn, $_POST['down_payment']);
      $finance_amount = mysqli_real_escape_string($conn, $_POST['finance_amount']);
      $rep_commission = mysqli_real_escape_string($conn, $_POST['rep_commission']);
      $notes = mysqli_real_escape_string($conn, $_POST['notes']);
      $balance_remaining = 0;
      $sale_price = 0;

      $sql_price = "SELECT sale_price FROM vehicle WHERE vehicle_id ='$vehicle_id'";
      $results = $conn->query($sql_price);

      if ($results->num_rows > 0)
      {
        $row = $results->fetch_assoc();
        $sale_price = $row['sale_price'];
        $balance_remaining = $row['sale_price'] - $down_payment;
      } else
      {
        echo "Error: " . $sql_price . "<br>" . $conn->error;
        die();
      }
      $number_payments = $sale_price / 24;

      $sql = "INSERT INTO car_sale (customer_id, emp_id, vehicle_id, date_sold, down_payment, finance_amount,
      balance_remaining, rep_commission, number_payments, notes) VALUES ('$customer_id', '$emp_id', '$vehicle_id',
      '$date_sold', '$down_payment', '$finance_amount', '$balance_remaining', '$rep_commission', '$number_payments', '$notes')";

      if ($conn->query($sql) === TRUE)
      {
        header('Location: ../car_sale');
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
      }
      $conn->close();
  }
 ?>
