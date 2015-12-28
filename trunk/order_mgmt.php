<?php
require_once('lib.php');


// ------------------------------------------------------------ // 

$curr_cust_user=$_COOKIE["user"];


if ($_POST['dateSelection']==7){
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-7, date("y")); // DEFAULT: get from 7 days ago
	$beginDate= date("m/d/Y", $prev_date); 
	$date = 7;
} else if($_POST['dateSelection']==30){
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-30, date("y")); // get from 30 days ago
	$beginDate= date("m/d/Y", $prev_date); 	
	$date = 30;
} else if($_POST['dateSelection']==100){
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-100, date("y")); // get from 100 days ago
	$beginDate= date("m/d/Y", $prev_date); 	
	$date = 100;	
} else {
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-7, date("y")); // DEFAULT: get from 7 days ago
	$beginDate= date("m/d/Y", $prev_date);
	$date = 7;	
}

	$today = mktime(0, 0, 0, date("m"), date("d"), date("y"));
	$endDate = date("m/d/Y", $today); 
	

// ------------------------------------------------------------ // 


?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
    <script language="JavaScript" src="gen_validatorv31.js" type="text/javascript"></script>   
    <script language="JavaScript" src="admin/datetimepicker.js"></script>
    <script language="JavaScript" src="find.js"></script>
 
  </head>
  <body>
  
    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="cust_home.php" style="color:#FFF">Customer Home Page </a> ---> View all orders for Customer
  </div>
  <!-- /BreadCrumbs -->
    
    
  <form action="order_mgmt.php" method="POST" name="change_dates">
    <? include('error.php'); ?>
    <table class="box">
      <tr>
        <td>Received Within: </td>
        <td><SELECT NAME="dateSelection" >
			<OPTION VALUE="7" <? if ($_POST['dateSelection']==7) { echo "selected"; } ?>>Last 7 Days
			<OPTION VALUE="30" <? if ($_POST['dateSelection']==30) { echo "selected"; } ?>>Last 30 Days
			<OPTION VALUE="100" <? if ($_POST['dateSelection']==100) { echo "selected"; } ?>>Last 100 Days
			</SELECT>
        </td>
        <td><input type="Submit" value="Update" class="btn_small" /></td>        
      </tr>
    </table>
    </form>     

<input type="button" value="Search by Keyword" onClick="searchPrompt('', false);">     

  <?

echo "

<table class='box' style='font-size: 12px;'>
<tr>
<th>Ship Date</th>
<th>Customer<br> PO</th>
<th>Sunsilks<br> Inv</th>
<th>Cust Item</th>
<th>Approx Ship Date ***</th>
<th>Yardage</th>
<th>Tracking Number</th>
<th>Service Options</th>
</tr>";


$result = mysql_query("SELECT DISTINCT *,  DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM FROM cust_order NATURAL JOIN cust_user NATURAL JOIN order_roll WHERE CUST_ID = $curr_user_id AND REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY SHIP_DATE DESC, REC_DATE DESC  ");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
	if($row['SHIP_DATE_FORM']=='00/00/0000'){
		$ShipDate = '----------';
	} else {
		$ShipDate = $row['SHIP_DATE_FORM'];
	}
  echo "<td>" . $ShipDate . "</td>";
  echo "<td>" . $row['CUST_PO_NUM'] . "</td>";
	if($row['INVOICE_NUM']=='0'){
		$invNum = '----------';
	} else {
		$invNum = $row['INVOICE_NUM'];
	}  
  echo "<td>" . $invNum . "</td>";
  echo "<td>" . $row['CUST_ITEM_NUM'] . "</td>";
	$rec_date_convert = strtotime($row['REC_DATE']);
	$rec_date_convert += 24 * 60 * 60 * 10; // (add 10 days)
	$ApproxShipDate = date("m/d/Y", $rec_date_convert);
	if($row['SHIP_DATE_FORM']!='00/00/0000'){
		$ApproxShipDate = '----------';
	}
  echo "<td>" . $ApproxShipDate . "</td>";  
  echo "<td>" . $row['YARDAGE'] . "</td>";
  if($row['TRACKING_NUM']=="1ZY81E65"){ echo "<td></td>"; } else { echo '<td>' . $row['TRACKING_NUM'] . '</td>'; }
  echo "<td>" . $row['SERVICE_OPTIONS'] . "</td>";
  echo "</tr>";
  echo "<tr><td colspan=20><hr></td></tr>";
  }


echo "</table>";



?>


<table class="box">
<tr><td style="font-size:12px;">
*** Approx 8 to 10 Business Days excluding weekends & holidays.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This is an estimate... actual shipping dates may vary. 
</td></tr>
</table>
  </body>
</html>

<? mysql_close($conn); ?>