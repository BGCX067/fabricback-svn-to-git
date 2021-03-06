<?php
require_once('lib.php');


// ------------------------------------------------------------ // 

if ( $_COOKIE['beginDateCookie'] && $_COOKIE['endDateCookie'] && $_COOKIE['userDateCookie']=='backup_view' ){
	
	$beginDate = $_COOKIE['beginDateCookie'];
	$endDate = $_COOKIE['endDateCookie'];
} else {
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-7, date("y")); // DEFAULT: get from 7 days ago
	$beginDateDefault= date("m/d/Y", $prev_date); 
	$today = mktime(0, 0, 0, date("m"), date("d"), date("y"));
	$endDateDefault = date("m/d/Y", $today); 
	
	$beginDate = $beginDateDefault;
	$endDate = $endDateDefault;
}
	
if(  $_POST['beginDatePost'] && $_POST['endDatePost']  ){
	setcookie("beginDateCookie"," ",time()-3600);
	setcookie("endDateCookie"," ",time()-3600);	
	setcookie("userDateCookie"," ",time()-3600);	

	setcookie("beginDateCookie", $_POST['beginDatePost']);
	setcookie("endDateCookie", $_POST['endDatePost']);
	setcookie("userDateCookie", "backup_view");	
	$beginDate = $_POST['beginDatePost']; 
	$endDate = $_POST['endDatePost'];
}

// The above code remembers a date that you set for a specific customer. if no date is set, it resorts to the default

// ------------------------------------------------------------ // 

if ( $_POST['cust_chosen'] ){
	$cust_chosen = $_POST['cust_chosen'];
} else {
	$cust_chosen = 'All Customers';
}


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
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> View all orders for all customers
  </div>
  <!-- /BreadCrumbs -->
    
  <h1>All Rolls in All Orders for <yellow><? echo $cust_chosen ?></yellow> from <yellow><? echo $beginDate ?> to <? echo $endDate ?></h1>

  <form action="backup_view.php" method="POST" name="cust_in_view">
    <table class="box">
      <tr>
        <td>* Customer</td>
        <td>
        <select name="cust_chosen">
        <option value="All Customers">All Customers</option>
        
<?     
$cust_query = mysql_query(" SELECT * FROM cust_user  ");
while($row_cust = mysql_fetch_array($cust_query)){
	if ($row_cust['USERNAME'] == $cust_chosen){
	    echo '<option  selected  value="' . $row_cust['USERNAME'] . '">' . $row_cust['USERNAME'] . '</option>' ; 
	} else {
	    echo '<option value="' . $row_cust['USERNAME'] . '">' . $row_cust['USERNAME'] . '</option>' ; 
	}
}
?>

		</select>
        
        
        </td>
        <td><input type="Submit" class="btn_small" /></td>

      </tr>      
    </table>
    </form>    

  <form action="backup_view.php" method="POST" name="change_dates">
    <? include('error.php'); ?>
    <table class="box">
      <tr>
        <td>* Start Date</td>
        <td><input type="text" name="beginDatePost" id="beginDate" value="<? echo $beginDate ?>" /></td>
        <td><a href="javascript:NewCal('beginDate','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
        <td>* End Date</td>
        <td><input type="text" name="endDatePost" id="endDate" value="<? echo $endDate ?>" /></td>
        <td><a href="javascript:NewCal('endDate','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
        <td><input type="Submit" value="Change Dates" class="btn_small" /></td>
      </tr>      
    </table>
    </form>     


  

<table class="box" style="font-size: 12px;">


<?
if($cust_chosen == 'All Customers'){
$result = mysql_query("SELECT DISTINCT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM  FROM cust_order NATURAL JOIN cust_user NATURAL JOIN order_roll WHERE REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY USERNAME ASC,  REC_DATE DESC, CUST_PO_NUM DESC  ");
} else {
$result = mysql_query("SELECT DISTINCT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM  FROM cust_order NATURAL JOIN cust_user NATURAL JOIN order_roll WHERE USERNAME = '$cust_chosen' AND REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY USERNAME ASC,  REC_DATE DESC, CUST_PO_NUM DESC  ");
}

echo "<tr>";
echo "<th>Customer</th>";
if($view_ids){ echo '<th>Order ID</th>'; } 
echo "<th>Receive Date</th>";
echo "<th>Customer PO Num</th>";
echo "<th>Sunsilks Invoice Num</th>";
if($view_ids){ echo '<th>Roll ID</th>'; }
echo "<th>Cust Item Num</th>";
echo "<th>Serial Num</th>";
echo "<th>Yardage</th>";
echo "<th>Process Date</th>";
echo "<th>Ship Date</th>";
echo "<th>Service Options</th>";
echo "<th>Tracking Number</th>";
echo "</tr>";
echo "<tr><td colspan=20><hr></td></tr>";
	
while($row = mysql_fetch_array($result))
  {	  
  echo "<tr>";
  echo "<td>" . $row['USERNAME'] . '<br>' . $row['SUN_CUST'] . "</td>";  
  if($view_ids){  echo "<td>" . $row['ORDER_ID'] . "</td>";   }
  echo "<td>" . $row['REC_DATE_FORM'] . "</td>";
  echo "<td>" . $row['CUST_PO_NUM'] . "</td>";
  echo "<td>" . $row['INVOICE_NUM'] . "</td>";
  if($view_ids){  echo "<td>" . $row['ROLL_ID'] . "</td>";   }
  echo "<td>" . $row['CUST_ITEM_NUM'] . "</td>";
  echo "<td>" . $row['SERIAL_NUM'] . "</td>";
  echo "<td>" . $row['YARDAGE'] . "</td>";
  echo "<td>" . $row['PROCESS_DATE_FORM'] . "</td>";
  echo "<td>" . $row['SHIP_DATE_FORM'] . "</td>";
  echo "<td>" . $row['SERVICE_OPTIONS'] . "</td>";
  if($row['TRACKING_NUM']=="1ZY81E65"){ echo "<td></td>"; } else { echo '<td>' . $row['TRACKING_NUM'] . '</td>'; }
  echo "<td><a href=\"javascript:void(0);\"  onclick=\"window.open('edit_roll_timesheet.php?rid=".$row['ROLL_ID']."&view_id=1&serial_num=".$row['SERIAL_NUM']."','_blank','height=600 , width=1200 , resizable=1, scrollbars=1')\">Time Sheet</a></td>";  
  echo "<td><a href=\"javascript:void(0);\" onclick=\" javascript: printSelection(" . $row['CUST_ID'] . ", " . $row['ORDER_ID'] . " , " . $row['ROLL_ID'] . "); \">Print Slip</a></td>";
  echo "</tr>";

  echo "<tr><td colspan=20><hr></td></tr>";

  }
echo "</table>";


?>

<?
    //  echo "<button class=\"btn\" href=\"javascript:void(0);\" onclick=\" javascript: printAll(); \">** PRINT ALL SLIPS IN CURRENT VIEW **</button>";
?>

<script>
function printSelection(cid,oid,rid){
	
	var winLink = 'print_roll_slip.php?cid='+cid+'&oid='+oid+'&rid='+rid;
	// alert(winLink);
  	var pwin=window.open(winLink,'print_content','width=800,height=500');
	
	return false;

}

function printAll(){
	var startDate = <?= json_encode($beginDate) ?>;
	var endDate = <?= json_encode($endDate) ?>;
	//alert(startDate + " " + endDate);
	var winLink = 'print_all.php?beginDate='+startDate+'&endDate='+endDate;
  	var pwin=window.open(winLink,'print_content','width=800,height=500');

	
}
</script>
  </body>
</html>

<? mysql_close($conn); ?>                                                                                                                                                                            