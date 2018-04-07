<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main-style.css">
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
            padding: 5px;
            text-align: left;
            }
        </style>
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
              function showCoSign(str)
              {
              if (str == "") {
                  document.getElementById("cosign_info").innerHTML = "";
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
                      document.getElementById("cosign_info").innerHTML = this.responseText;
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
<html>
    <body>
        <?php include 'header.php';
        include 'connectdb.php';
        connect_sql();
        $conn = connect_sql();
        ?>

        <form action="warranty.php" method="post">
            <fieldset>
                <legend><h2>Warranty Form</h2></legend>
                <?php echo "<p>Select an existing customer <select name='customer_id' onchange= \"showCustomerInfo(this.value)\" required>";
                        echo "<option value=''>Select customer</option>";
                        $sql2 = "SELECT customer_id, last_name, email from customer";
                        $results = $conn->query($sql2);
                        while($row = $results->fetch_assoc()){
                          echo "<option value=" .$row['customer_id']. ">" . $row['last_name'] . ", " .$row['email'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                        </select>
                        &nbsp; or create a new one <a id="custModal" href="#animatedModal"> HERE.</a></p>

                    <fieldset>
                        <legend>Existing Customer Information</legend>
                        <p id="customer_info"> </p>
                    </fieldset>
                    <?php echo "<p>Select an existing customer as the co-signer <select name='customer_id' onchange= \"showCoSign(this.value)\" required>";
                            echo "<option value=''>Select customer</option>";
                            $sql2 = "SELECT customer_id, last_name, email from customer";
                            $results = $conn->query($sql2);
                            while($row = $results->fetch_assoc()){
                              echo "<option value=" .$row['customer_id']. ">" . $row['last_name'] . ", " .$row['email'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                            </select>
                            &nbsp; or create a new one <a id="custModal" href="#animatedModal"> HERE.</a></p>

                        <fieldset>
                            <legend>Existing Customer Information</legend>
                            <p id="cosign_info"> </p>
                    </fieldset>
                <br/>
                    <fieldset>
                        <legend>Salesperson Information</legend>
                        <?php
                          $sql = "SELECT emp_id, first_name, last_name FROM employee";
                          $results = $conn->query($sql);
                          echo "Salesperson ID <select name='emp_id' onchange= \"showEmployeeInfo(this.value)\" required>";
                          echo "<option value=''>Select salesperson</option>";
                          while($row = $results->fetch_assoc())
                          {
                            echo "<option value=" .$row['emp_id'] . ">" . $row['emp_id'] . "</option>";
                          }
                          echo "</select>";
                        ?>
                        <p id="employee_info"> </p>
                </fieldset>
                <p>Warranty Sale Date: <input type="date" name="sale_date"required></p>
                <p>Total Cost:<input type="number" name="total_cost"required>&nbsp;Monthly Cost:<input type="number" name="monthly_cost"required></p>

                <table id="tables">
                    <tr>
                        <th>Warranty ID</th>
                        <th>Start Date</th>
                        <th>Length</th>
                        <th>Cost</th>
                        <th>Deductible</th>
                        <th>Items Covered</th>
                    </tr>
                    <tr>
                        <td><select name="warranty_code1">

                            <!--prefilled options-->

                            </select></td>
                        <td><input type="date" name="start_date1"></td>
                        <td><input type="number" name="length1"></td>
                        <td><input type="number" name="cost1"></td>
                        <td><input type="number" name="deductible1"></td>
                        <td><textarea name="covered_items1"></textarea></td>
                    </tr>
                    <tr>
                        <td><select name="warranty_code2">

                            <!--prefilled options-->

                            </select></td>
                        <td><input type="date" name="start_date2"></td>
                        <td><input type="number" name="length2"></td>
                        <td><input type="number" name="cost2"></td>
                        <td><input type="number" name="deductible2"></td>
                        <td><textarea name="covered_items2"></textarea></td>
                    </tr>
                    <tr>
                        <td><select name="warranty_code3">

                            <!--prefilled options-->

                            </select></td>
                        <td><input type="date" name="start_date3"></td>
                        <td><input type="number" name="length3"></td>
                        <td><input type="number" name="cost3"></td>
                        <td><input type="number" name="deductible3"></td>
                        <td><textarea name="covered_items3"></textarea></td>
                    </tr>
                    <tr>
                        <td><select name="warranty_code4">

                            <!--prefilled options-->

                            </select></td>
                        <td><input type="date" name="start_date4"></td>
                        <td><input type="number" name="length4"></td>
                        <td><input type="number" name="cost4"></td>
                        <td><input type="number" name="deductible4"></td>
                        <td><textarea name="covered_items4"></textarea></td>
                    </tr>
                    <tr>
                        <td><select name="warranty_code5">

                            <!--prefilled options-->

                            </select></td>
                        <td><input type="date" name="start_date5"></td>
                        <td><input type="number" name="length5"></td>
                        <td><input type="number" name="cost5"></td>
                        <td><input type="number" name="deductible5"></td>
                        <td><textarea name="covered_items5"></textarea></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name= "warranty_submit">

            </fieldset>
        </form>
    </body>
</html>
