<?php
  include 'connectdb.php';

  //connect to database
  connect_sql();
  $conn = connect_sql();

  if (isset($_POST['dealer_submit']))
  {
    $dealer_id="D-000000001";
    $company_name = $contact_first = $contact_last = $contact_phone = $company_phone = "";
    $contact_email = $notes = $province = $city = $street_name = $postal_code = "";

    $company_name = mysqli_real_escape_string($_POST['company_name']);
    $contact_first = mysqli_real_escape_string($_POST['contact_first']);
    $contact_last = mysqli_real_escape_string($_POST['contact_last']);
    $contact_phone = mysqli_real_escape_string($_POST['contact_phone']);
    $company_phone = mysqli_real_escape_string($_POST['company_phone']);
    $contact_email = mysqli_real_escape_string($_POST['contact_email']);
    $notes = mysqli_real_escape_string($_POST['notes']);
    $province = mysqli_real_escape_string($_POST['province']);
    $city = mysqli_real_escape_string($_POST['city']);
    $street_name = mysqli_real_escape_string($_POST['street_name']);
    $postal_code = mysqli_real_escape_string($_POST['postal_code']);

    $sql = "INSERT INTO dealer (dealer_id, company_name, contact_first, contact_last, contact_phone,
    company_phone, contact_email, notes, province, city, street_name, postal_code)
    VALUES ('$dealer_id', '$company_name', '$contact_first', '$contact_last', '$contact_phone', '$company_phone',
    '$contact_email', '$notes', '$province', '$city', '$street_name', '$postal_code')";

  	if ($conn->query($sql) === TRUE){
      header('Location: ../new_dealer');
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die();
    }

    $conn->close();
  }
 ?>
