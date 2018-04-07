<?php
  include 'connectdb.php';

  connect_sql();
  $conn = connect_sql();
?>
<html>
    <head>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/main-style.css">
        <style>
            #btn-close-modal {
                width:100%;
                text-align: center;
                cursor:pointer;
                color:#fff;
            }
        </style>
        <script>
            function showCarInfo(str) {
            if (str == "") {
                document.getElementById("carinfo").innerHTML = "";
                return;
            } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("carinfo").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","/carinfo.php?q="+str,true);
            xmlhttp.send();
        }
    }
    </script>
    <script>
          function showCustomerInfo(str)
          {
          if (str == "") {
              document.getElementById("customer_info").innerHTML = "";
              return;
          } else {
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("customer_info").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","/customerinfo.php?q="+str,true);
          xmlhttp.send();
          }
      }
    </script>
    <script>
          function showEmployeeInfo(str)
          {
          if (str == "") {
              document.getElementById("employee_info").innerHTML = "";
              return;
          } else {
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("employee_info").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","/employeeinfo.php?q="+str,true);
          xmlhttp.send();
          }
      }
    </script>
    </head>
    <body>
        <h1>Dealership Management System</h1>

        <form action="sales.php" method="post">
            <fieldset>
                <legend><h2>Car Sale Form</h2></legend>
                <p>Purchase Date: <input type="date" name="date_sold" required> &nbsp; Total Due: <input type="number" name="total_due" required></p>
                <p>Down Payment: <input type="number" name="down_payment" required> &nbsp; Finance Amount: <input type="number" name="finance_amount" required></p>
                <fieldset>
                    <legend>Salesperson Information</legend>
                    <?php
                      $sql = "SELECT emp_id, first_name, last_name FROM employee";
                      $results = $conn->query($sql);
                      echo "Salesperson ID <select name='emp_id' onchange= \"showCustomerInfo(this.value)\" required>";
                      echo "<option value=''>Select salesperson</option>";
                      while($row = $results->fetch_assoc())
                      {
                        echo "<option value=" .$row['emp_id'] . ">" . $row['emp_id'] . "</option>";
                      }
                      echo "</select>";
                    ?>
                    <p id="employee_info"> </p>
                </fieldset>
                <br/>
                <fieldset>
                    <legend>Vehicle Information</legend>
                    <?php
                      $sql1 = "SELECT vehicle_id from vehicle";
                      $results = $conn->query($sql1);
                      echo "Vehicle ID: <select name='vehicle_id' onchange= \"showCarInfo(this.value)\" required>";
                      echo "<option value=''>Select vehicle ID</option>";
                      while($row = $results->fetch_assoc()){
                            echo "<option value=" .$row['vehicle_id']. ">" . $row['vehicle_id'] . "</option>";
                      }
                      echo "</select>";
                    ?>

                    <p id="carinfo">
                    </p>

                </fieldset>
                <br/>
                <fieldset>
                <legend>Customer Information</legend>
                    <?php
                    $sql2 = "SELECT customer_id, last_name, email from customer";
                    $results = $conn->query($sql2);
                    echo "Select an existing customer <select name='customer_id' onchange= \"showCustomerInfo(this.value)\" required>";
                    echo "<option value=''>Select customer</option>";
                    while($row = $results->fetch_assoc()){
                      echo "<option value=" .$row['customer_id']. ">" . $row['last_name'] . ", " .$row['email'] . "</option>";
                    }
                    echo "</select>";
                    $conn->close();
                    ?>
                    &nbsp; or create a new one <a id="custModal" href="#animatedModal"> HERE.</a></p>

                    <fieldset>
                        <legend>Existing Customer Information</legend>
                        <p id="customer_info"> </p>
                    </fieldset>
                </fieldset>
                <br/>

                <br/>
                <input type="submit" name="sale_submit">

            </fieldset>
        </form>

        <!--DEMO01-->
        <div id="animatedModal">
            <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
            <div class="close-animatedModal">
                CLOSE MODAL
            </div>
            <center>
                <div class="modal-content" style="background-color: azure; border: 2px solid #000; width: 70%; width: 70%;">
                    <iframe src="new_customer.html" width="100%" height="800px"></iframe>
                </div>
            </center>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/animatedModal.min.js"></script>
        <script>
            $("#custModal").animatedModal();
        </script>
    </body>
</html>
