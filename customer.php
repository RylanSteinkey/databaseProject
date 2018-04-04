<?php
  include 'connectdb.php';

  //connect to database
  connect_sql();
  $conn = connect_sql();

  if (isset($_POST['customer_submit']))
  {
    $customer_id = "C-000000001";
    $employment_history_id = "H-000000001";
    $num_late_payment = 0;
    $avg_days_late= 0;
    $first_name = $last_name = $email = $phone = $city = $street_name = "";
    $postal_code = $province = $gender = $tax_id = $notes = "";

    $first_name = mysqli_real_escape_string($_POST ['first_name']);
    $last_name = mysqli_real_escape_string($_POST ['last_name']);
    $email = mysqli_real_escape_string($_POST ['email']);
    $phone = mysqli_real_escape_string($_POST ['phone']);
    $city = mysqli_real_escape_string($_POST ['city']);
    $street_name = mysqli_real_escape_string($_POST ['street_name']);
    $postal_code = mysqli_real_escape_string($_POST ['postal_code']);
    $province = mysqli_real_escape_string($_POST ['province']);
    $gender = mysqli_real_escape_string($_POST ['gender']);
    $tax_id = mysqli_real_escape_string($_POST ['tax_id']);
    $notes = mysqli_real_escape_string($_POST ['notes']);

    $employer = $title = $supervisor = $employer_phone = $employer_city = $employer_street = "";
    $employer_postal = $employer_province = $date_start = $date_end = "";

    $employer = mysqli_real_escape_string($_POST ['employer']);
    $title = mysqli_real_escape_string($_POST ['title']);
    $supervisor = mysqli_real_escape_string($_POST ['supervisor']);
    $employer_phone = mysqli_real_escape_string($_POST ['employer_phone']);
    $employer_city = mysqli_real_escape_string($_POST ['employer_city']);
    $employer_street = mysqli_real_escape_string($_POST ['employer_street']);
    $employer_postal = mysqli_real_escape_string($_POST ['employer_postal']);
    $employer_province = mysqli_real_escape_string($_POST ['employer_province']);
    $date_start = mysqli_real_escape_string($_POST ['start_date']);
    $date_end = mysqli_real_escape_string($_POST ['end_date']);

    $sql2 = "INSERT INTO customer_employment_history (customer_id, employment_history_id, employer, title,
    supervisor, phone, city, street_name, postal_code, province, start_date, end_date)
    VALUES('$customer_id', '$employment_history_id', '$employer', '$title', '$supervisor', '$employer_phone',
    '$employer_city', '$employer_street', '$employer_postal', '$employer_province' ,'$date_start', '$date_end')";

    if ($conn->query($sql2) === TRUE){
      $sql = "INSERT INTO customer (customer_id, first_name , last_name , email , phone , city , street_name,
      postal_code, province ,gender ,tax_id ,num_late_payments ,avg_days_late,
      notes ,employment_history_id)
      VALUES ('$customer_id', '$first_name', '$last_name', '$email', '$phone', '$city', '$street_name',
      '$postal_code', '$province' , '$gender' ,'$tax_id', '$num_late_payment', '$avg_days_late',
      '$notes', '$employment_history_id')";


      	if ($conn->query($sql) === TRUE){
          header('Location: ../new_customer');
          exit;
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          die();
        }

      }

    else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
      die();
    }



    $conn->close();
  }
 ?>
