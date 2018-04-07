<?php
  include 'connectdb.php';

  //connect to database
  connect_sql();
  $conn = connect_sql();

  if (isset($_POST['customer_submit']))
  {
    $num_late_payments = 0;
    $avg_days_late= 0;

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $dob = mysqli_real_escape_string($conn, $_POST['DOB']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $street_name = mysqli_real_escape_string($conn, $_POST['street_name']);
    $pcode = mysqli_real_escape_string($conn, $_POST['postal_code']);
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $tax_id = mysqli_real_escape_string($conn, $_POST['tax_id']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    $employer = mysqli_real_escape_string($conn, $_POST['employer']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $supervisor = mysqli_real_escape_string($conn, $_POST['supervisor']);
    $employer_phone = mysqli_real_escape_string($conn, $_POST['employer_phone']);
    $employer_city = mysqli_real_escape_string($conn, $_POST['employer_city']);
    $employer_street = mysqli_real_escape_string($conn, $_POST['employer_street']);
    $employer_postal = mysqli_real_escape_string($conn, $_POST['employer_postal']);
    $employer_province = mysqli_real_escape_string($conn, $_POST['employer_province']);
    $date_start = mysqli_real_escape_string($conn, $_POST['start_date']);
    $date_end = mysqli_real_escape_string($conn, $_POST['end_date']);



    $sql = "INSERT INTO customer (first_name , last_name, gender, DOB, phone, email, tax_id , num_late_payments,
    avg_days_late, street_name ,city ,province ,postal_code ,notes)
    VALUES ('$first_name', '$last_name', '$gender', '$dob', '$phone', '$email',
    '$tax_id', '$num_late_payments' , '$avg_days_late' ,'$street_name', '$city', '$province', '$pcode', '$notes')";

    if ($conn->query($sql) === TRUE)
    {
      $customer_id = $conn->insert_id;

      $sql2 = "INSERT INTO customer_employment_history (customer_id, employer, title,
      supervisor, start_date, end_date, phone, city, street_name, postal_code, province)
      VALUES('$customer_id', '$employer', '$title', '$supervisor', '$date_start', '$date_end', '$employer_phone',
      '$employer_city', '$employer_street', '$employer_postal', '$employer_province')";
      if ($conn->query($sql2) === TRUE)
      {
        if (empty($_POST['employer2'])){
          header('Location: ../new_customer');
          exit;
        } else {
          $employer2 = mysqli_real_escape_string($conn, $_POST['employer2']);
          $title2 = mysqli_real_escape_string($conn, $_POST['title2']);
          $supervisor2 = mysqli_real_escape_string($conn, $_POST['supervisor2']);
          $employer_phone2 = mysqli_real_escape_string($conn, $_POST['employer_phone2']);
          $employer_city2 = mysqli_real_escape_string($conn, $_POST['employer_city2']);
          $employer_street2 = mysqli_real_escape_string($conn, $_POST['employer_street2']);
          $employer_postal2 = mysqli_real_escape_string($conn, $_POST['employer_postal']);
          $employer_province2 = mysqli_real_escape_string($conn, $_POST['employer_province2']);
          $date_start2 = mysqli_real_escape_string($conn, $_POST['start_date2']);
          $date_end2 = mysqli_real_escape_string($conn, $_POST['end_date2']);

          $sql3 = "INSERT INTO customer_employment_history (customer_id, employer, title,
          supervisor, start_date, end_date, phone, city, street_name, postal_code, province)
          VALUES('$customer_id', '$employer2', '$title2', '$supervisor2', '$date_start2', '$date_end2', '$employer_phone2',
          '$employer_city2', '$employer_street2', '$employer_postal2', '$employer_province2')";
          if ($conn->query($sql3) === TRUE)
          {
            header('Location: ../new_customer');
            exit;
          } else
          {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
          }
        }
      } else
      {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
      }

    }else
    {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die();
    }

    $conn->close();
  }
 ?>
