<?php
require_once('lib.php');

$oid=$_GET['oid'];

?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
    <script language="JavaScript" src="../gen_validatorv31.js" type="text/javascript"></script>   
    <script language="JavaScript" src="datetimepicker.js"></script>
    
  </head>
  <body>
  
    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="cust_home.php" style="color:#FFF">Customer Home Page </a> ---> <a href="order_mgmt.php" style="color:#FFF">Order Management</a> ---> Roll Management
  </div>
  <!-- /BreadCrumbs -->

  
  <?
  $result = mysql_query("SELECT * FROM order_roll NATURAL JOIN cust_order NATURAL JOIN cust_user WHERE ORDER_ID='$oid' AND CUST_ID='$curr_user_id'");

echo "
    <h1>
      View Rolls in this order
    </h1>

<table class='box'>
<tr>
<th>Roll ID</th>
<th>Yardage</th>
<th>Process Date</th>
<th>Ship Date</th>
<th>Service Options</th>
<th>Tracking Number</th>
</tr>";



while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ROLL_ID'] . "</td>";
  echo "<td>" . $row['YARDAGE'] . "</td>";
  echo "<td>" . $row['PROCESS_DATE'] . "</td>";
  echo "<td>" . $row['SHIP_DATE'] . "</td>";
  echo "<td>" . $row['SERVICE_OPTIONS'] . "</td>";
  echo "<td>" . $row['TRACKING_NUM'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>


  </body>
</html>

<? mysql_close($conn); ?>