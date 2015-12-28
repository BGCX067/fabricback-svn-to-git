<?php
require_once('lib.php');

$cid=$_GET['cid'];
$oid=$_GET['oid'];
$rid=$_GET['rid'];


$query=" SELECT *, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM FROM order_roll WHERE roll_ID='$rid' ";
$result=mysql_query($query);

$cust_item_num=mysql_result($result,$i,"CUST_ITEM_NUM");
$serial_num=mysql_result($result,$i,"SERIAL_NUM");
$yardage=mysql_result($result,$i,"YARDAGE");
$process_date=mysql_result($result,$i,"PROCESS_DATE_FORM");
$ship_date=mysql_result($result,$i,"SHIP_DATE_FORM");
$service_options=mysql_result($result,$i,"SERVICE_OPTIONS");
$tracking_num=mysql_result($result,$i,"TRACKING_NUM");

if($_POST['barcodeSubmit']){
	$rid = substr($_POST['barcode'],-4,3); // EDIT THIS LATER
	// echo $rid;
	$query2=" SELECT *, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM FROM order_roll WHERE roll_ID='$rid' ";
	$result2=mysql_query($query2);
		
	$cust_item_num=mysql_result($result2,$i,"CUST_ITEM_NUM");
	$serial_num=mysql_result($result2,$i,"SERIAL_NUM");
	$yardage=mysql_result($result2,$i,"YARDAGE");
	$process_date=mysql_result($result2,$i,"PROCESS_DATE_FORM");
	$ship_date=mysql_result($result2,$i,"SHIP_DATE_FORM");
	$service_options=mysql_result($result2,$i,"SERVICE_OPTIONS");
	$tracking_num=mysql_result($result2,$i,"TRACKING_NUM");
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
  <? if (!$_POST['barcodeSubmit'])
  { 
    echo '<div style="font-size:12px; color:#FFF">Your Location:<a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> 
	<a href="cust_mgmt.php" style="color:#FFF">Customer Management </a> ---> <a href="order_mgmt.php?cid='.$cid.'&oid='.$oid.'" style="color:#FFF"> 
	Order Management </a> ---> <a href="roll_mgmt.php?cid='.$cid.'&oid='.$oid.'" style="color:#FFF"> Roll Management </a> ---> Edit Roll</div>';
  }
  ?>
  <!-- /BreadCrumbs -->
  
  
  <form <? if (!$_POST['barcodeSubmit']) { echo '  action="roll_mgmt.php?cid=' . $cid . '&oid=' . $oid . '&rid=' . $rid . ' " method="POST" name="edit_roll"  ' ;} else { echo '  action="barcode_reader.php?rid='.$rid.'" method="POST" name="edit_roll"  ' ; } ?>>
    <? include('error.php'); ?>
    <h1>
      Update a Roll in an Order
    </h1>
    <table class="box">
      <tr>
        <td>* Customer Item Num</td>
        <td><input type="text" name="cust_item_num" value="<? echo $cust_item_num ?>"  /></td>
      </tr>
      <tr>
        <td>* Yardage</td>
        <td><input type="text" name="yardage" value="<? echo $yardage ?>"  /></td>
      </tr>
      <tr>
        <td>* Process Date</td>
        <td><input type="text" name="process_date" id="process_date" value="<? echo $process_date ?>" /></td>
        <td><a href="javascript:NewCal('process_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <tr>
        <td>* Ship Date</td>
        <td><input type="text" name="ship_date" id="ship_date" value="<? echo $ship_date ?>"  /></td>
        <td><a href="javascript:NewCal('ship_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <tr>
        <td>* Service Options</td>
        <td><input type="text" name="service_options" value="<? echo $service_options ?>"  /></td>
      </tr>
      <tr>
        <td>* Tracking Number</td>
        <td><input type="text" name="tracking_num" value="<? if($tracking_num){ echo $tracking_num; } else { echo "1ZY81E65"; } ?>"  /></td>
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="updateBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("edit_roll");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("serial_num","req","Please enter a serial code");
 frmvalidator.addValidation("serial_num","minlength=2");
 frmvalidator.addValidation("serial_num","maxlength=3");

</script>
  
  </body>
</html>

<? mysql_close($conn); ?>