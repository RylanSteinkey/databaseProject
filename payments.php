<?php
include 'connectdb.php';

connect_sql();
$conn = connect_sql();

if (isset($_POST['customer_id'])) $customer_id = $_POST['customer_id'];
if (isset($_POST['num_late_payments'])) $num_late_payments = $_POST['num_late_payments'];
if (isset($_POST['avg_days_late'])) $avg_days_late = $_POST['avg_days_late'];

//payment
if (isset($_POST['date_due'])) $date_due = $_POST['date_due'];
if (isset($_POST['amount_due'])) $amount_due = $_POST['amount_due'];
if (isset($_POST['date_due'])) $date_due = $_POST['date_due'];
if (isset($_POST['amount_paid'])) $amount_paid = $_POST['amount_paid'];
if (isset($_POST['date_paid'])) $date_paid = $_POST['date_paid'];
if (isset($_POST['bank_account'])) $bank_account = $_POST['bank_account'];

if (isset($_POST['payment_submit']))
{
  $sql = "INSERT INTO payments (customer_id, date_due, amount_due, amount_paid, date_paid, bank_account)
  VALUES ('$customer_id', '$date_due', '$amount_due', '$amount_paid', '$date_paid', '$bank_account')";
  if ($conn->query($sql) === TRUE)
  {
    $sql2 = "UPDATE customer SET num_late_payments = '$num_late_payments', avg_days_late = '$avg_days_late'
    WHERE customer_id ='$customer_id'";

    if($conn->query($sql2) === TRUE)
    {
      header('Location: ../payment.html');
      exit;
    }
    else
    {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die();
    }
  } else
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
  }
}







?>
