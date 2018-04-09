<?php
include 'connectdb.php';

connect_sql();
$conn = connect_sql();

if (isset($_POST['emp_id'])) $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
if (isset($_POST['customer_id'])) $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
if (isset($_POST['warranty_code'])) $warranty_code = mysqli_real_escape_string($conn, $_POST['warranty_code']);
if (isset($_POST['sale_date'])) $sale_date = mysqli_real_escape_string($conn, $_POST['sale_date']);
if (isset($_POST['total_cost'])) $total_cost = mysqli_real_escape_string($conn, $_POST['total_cost']);
if (isset($_POST['monthly_cost'])) $monthly_cost = mysqli_real_escape_string($conn, $_POST['monthly_cost']);

$sql = "INSERT INTO sold_warranty (warranty_id, emp_id, customer_id, sale_date, total_cost, monthly_cost)
VALUES ('$warranty_code', '$emp_id', '$customer_id', '$sale_date', '$total_cost', '$monthly_cost')";

if ($conn->query($sql) === TRUE)
{
  if (empty($_POST['warranty_code2']))
  {
    header('Location: ../warranty');
    exit;
  } else
  {
    $warranty_code2 = mysqli_real_escape_string($conn, $_POST['warranty_code2']);

    $sql2 = "INSERT INTO sold_warranty (warranty_id, emp_id, customer_id, sale_date, total_cost, monthly_cost)
    VALUES ('$warranty_code2', '$emp_id', '$customer_id', '$sale_date', '$total_cost', '$monthly_cost')";
    if ($conn->query($sql2) === TRUE){
      header('Location: ../warranty');
      exit;
    } else
    {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
      die();
    }
  }
  $conn->close();
}
?>
