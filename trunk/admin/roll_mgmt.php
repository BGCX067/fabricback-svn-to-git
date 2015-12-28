<?php
require_once('lib.php');


$cid=$_GET['cid'];
$oid=$_GET['oid'];
$rid=$_GET['rid'];

$addBool=$_POST['addBool'];
if($addBool){
	
	$queryGetCurrRoll=mysql_query("    SELECT cust_user.CURR_ROLL FROM cust_user WHERE cust_user.CUST_ID='$cid'  ");
	$currNextRoll = mysql_result($queryGetCurrRoll,0,"CURR_ROLL") + 1;
	
	$serial_num = $_POST['serial_num'] . $currNextRoll;
		
	$query = "    INSERT INTO order_roll VALUES ('','$cust_item_num','$serial_num','$yardage',STR_TO_DATE('$process_date','%m/%d/%Y'),STR_TO_DATE('$ship_date','%m/%d/%Y'),'$service_options','$tracking_num','$oid','','','','')          ";
	$query2 = "    UPDATE	cust_user SET	cust_user.CURR_ROLL = '$currNextRoll'  WHERE    cust_user.CUST_ID =  '$cid'  ";
	
	if(   !mysql_query($query)  || !mysql_query($query2)  ) {
		echo "<echoBox  id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox  id=\"fade\">1 record added</echoBox>";
	}

}

$updateBool=$_POST['updateBool'];
if($updateBool){
	$query = "   UPDATE	order_roll SET	order_roll.CUST_ITEM_NUM='$_POST[cust_item_num]', order_roll.YARDAGE='$_POST[yardage]', order_roll.PROCESS_DATE=STR_TO_DATE('$_POST[process_date]','%m/%d/%Y'), order_roll.SHIP_DATE=STR_TO_DATE('$_POST[ship_date]','%m/%d/%Y'), order_roll.SERVICE_OPTIONS='$_POST[service_options]', order_roll.TRACKING_NUM='$_POST[tracking_num]' WHERE	order_roll.ROLL_ID='$rid'  ";
	
	if(!mysql_query($query)) {
		echo "<echoBox  id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox  id=\"fade\">1 record updated</echoBox>";
	}

}

$did=$_GET['did'];
if($did!=''){
	$query = "  DELETE FROM order_roll  WHERE order_roll.ROLL_ID='$did'   ";
	
	if(!mysql_query($query)) {
		echo "<echoBox  id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox  id=\"fade\">roll deleted from the order</echoBox>";
	}
	

}

$queryIdentifier=mysql_query("SELECT cust_user.USERNAME FROM cust_user WHERE cust_user.CUST_ID='$cid'");
$resultIdentifier=mysql_result($queryIdentifier,0,"USERNAME");

$queryOrderIdentifier=mysql_query("SELECT cust_order.CUST_PO_NUM FROM cust_order WHERE cust_order.ORDER_ID='$oid'");
$resultOrderIdentifier=mysql_result($queryOrderIdentifier,0,"CUST_PO_NUM");



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
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="cust_mgmt.php" style="color:#FFF">Customer Management </a> ---> <a href="order_mgmt.php?cid=<? echo $cid ?>&oid=<? echo $oid ?>" style="color:#FFF"> Order Management </a> ---> Roll Management
  </div>
  <!-- /BreadCrumbs -->

<? include('error.php'); ?>
  
 
<h1>
      View Rolls in <yellow> Cust PO Num: <? echo $resultOrderIdentifier;  ?></yellow> for <yellow><? echo $resultIdentifier; ?></yellow>
</h1>

<table class="box">
<tr>
<? if($view_ids){ echo '<th>Order ID</th>'; } ?>
<th>Cust Item Num</th>
<th>Serial Num</th>
<th>Yardage</th>
<th>Receive Date</th>
<th>Process Date</th>
<th>Ship Date</th>
<th>Service Options</th>
<th>Tracking Number</th>
</tr>

<?
$result = mysql_query("SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM FROM order_roll NATURAL JOIN cust_order WHERE ORDER_ID='$oid' ORDER BY ROLL_ID DESC");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>"; 
  if($view_ids){  echo "<td>" . $row['ROLL_ID'] . "</td>";  }
  echo "<td>" . $row['CUST_ITEM_NUM'] . "</td>";
  echo "<td>" . $row['SERIAL_NUM'] . "</td>";
  echo "<td>" . $row['YARDAGE'] . "</td>";
  echo "<td>" . $row['REC_DATE_FORM'] . "</td>";
  echo "<td>" . $row['PROCESS_DATE_FORM'] . "</td>";
  echo "<td>" . $row['SHIP_DATE_FORM'] . "</td>";
  echo "<td>" . $row['SERVICE_OPTIONS'] . "</td>";
  echo "<td>" . $row['TRACKING_NUM'] . "</td>";

  echo "<td><a href=\"edit_roll.php?cid=" . $cid . "&oid=" . $row['ORDER_ID'] . "&rid=" . $row['ROLL_ID'] . "\">Modify Roll</a></td>";
  echo "<td><a href=\"roll_mgmt.php?cid=" . $cid . "&oid=" . $row['ORDER_ID'] . "&did=" . $row['ROLL_ID'] . "\" onclick=\"return confirm('Are you sure you want to delete this entry?')\">Delete Roll</a></td>";
  echo "<td><a href=\"#\" onclick=\" javascript: printSelection(" . $cid . ", " . $row['ORDER_ID'] . " , " . $row['ROLL_ID'] . "); \">Print Slip</a></td>";
  
  if($test_mode){ echo "<td><a href=\"#\" onclick=\" javascript: printBarcode(" . $cid . ", " . $row['ORDER_ID'] . " , " . $row['ROLL_ID'] . ") \">Test Barcode</a></td>" ; }
  if($test_mode){ echo "<td><a href=\"edit_roll_time.php?cid=" . $cid . "&oid=" . $row['ORDER_ID'] . "&rid=" . $row['ROLL_ID'] . "\">Time Sheet</a></td>"; }


  echo "</tr>";
  }
echo "</table>";

?>

<script>


function printSelection(cid,oid,rid){
	
	var winLink = 'print_roll_slip.php?cid='+cid+'&oid='+oid+'&rid='+rid;
	// alert(winLink);
  	var pwin=window.open(winLink,'print_content','width=800,height=500');

}

function printBarcode(cid,oid,rid){
	
	var winLink = 'print_roll_slip_barcode.php?cid='+cid+'&oid='+oid+'&rid='+rid;
	// alert(winLink);
  	var pwin=window.open(winLink,'print_content','width=800,height=500');

}

</script>


  <form action="roll_mgmt.php?cid=<? echo $cid; ?>&oid=<? echo $oid ?>" method="POST" name="create_roll">
    <? include('error.php'); ?>
    <h1>
      Create an New Roll in this Order
    </h1>
    <table class="box">
      <tr>
        <td>* Customer Item Num</td>
        <td><input type="text" name="cust_item_num" /></td>
      </tr>
      <tr>
        <td>* Serial Code</td>
        <td><input type="text" name="serial_num" /></td>
      </tr>
      <tr>
        <td>* Yardage</td>
        <td><input type="text" name="yardage" /></td>
      </tr>
      <tr>
        <td>* Process Date</td>
        <td><input type="text" name="process_date" id="process_date" /></td>
        <td><a href="javascript:NewCal('process_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <tr>
        <td>* Ship Date</td>
        <td><input type="text" name="ship_date" id="ship_date" /></td>
        <td><a href="javascript:NewCal('ship_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <tr>
        <td>* Service Options</td>
        <td><input type="text" name="service_options" /></td>
      </tr>
      <tr>
        <td>* Tracking Number</td>
        <td><input type="text" name="tracking_num" value="1ZY81E65" /></td>
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
        <input type="hidden" name="addBool" value="true" />
        <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
    </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("create_roll");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("serial_num","req","Please enter a serial code");
 frmvalidator.addValidation("serial_num","minlength=2");
 frmvalidator.addValidation("serial_num","maxlength=3");

</script>


  </body>
</html>

<? mysql_close($conn); ?>