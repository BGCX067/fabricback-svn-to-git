<?php
require_once('lib.php');

$cid=$_GET['cid'];
$oid=$_GET['oid'];

$query=" SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PO_REC_DATE, '%m/%d/%Y') AS PO_REC_DATE_FORM FROM cust_order WHERE ORDER_ID='$oid' ";
$result=mysql_query($query);

$invoice_num=mysql_result($result,$i,"INVOICE_NUM");
$cust_po_num=mysql_result($result,$i,"CUST_PO_NUM");
$sun_cust=mysql_result($result,$i,"SUN_CUST");
$rec_date=mysql_result($result,$i,"REC_DATE_FORM");
$po_rec_date=mysql_result($result,$i,"PO_REC_DATE_FORM");


$queryIdentifier=mysql_query("SELECT cust_user.USERNAME FROM cust_user WHERE cust_user.CUST_ID='$cid'");
$resultIdentifier=mysql_result($queryIdentifier,0,"USERNAME");

if($resultIdentifier == 'GASUIN'){
	$show_sun_cust = true;
	$show_po_rec_date = true;
	$sortby_po_rec_date = true;
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
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="cust_mgmt.php" style="color:#FFF">Customer Management </a> ---> <a href="order_mgmt.php?cid=<? echo $cid ?>&oid=<? echo $oid ?>" style="color:#FFF"> Order Management </a> ---> Edit Order
  </div>
  <!-- /BreadCrumbs -->
  
  
  <form action="order_mgmt.php?cid=<? echo $cid; ?>&oid=<? echo $oid; ?>" method="POST" name="edit_order">
    <? include('error.php'); ?>
    <h1>
      Update a Customer Order
    </h1>
    <table class="box">
      <tr>
        <td>* Cust PO Num</td>
        <td><input type="text" name="cust_po_num" value="<? echo $cust_po_num ?>"  /></td>
      </tr> 
      <tr>
        <td>* Sunsilks Invoice Num</td>
        <td><input type="text" name="invoice_num" value="<? echo $invoice_num ?>"  /></td>
      </tr>     
      <tr>
        <td>
          * Receive Date
        </td>
        <td>
          <input type="text" name="rec_date" value="<? echo $rec_date ?>" id="rec_date" />
        </td>
        <td><a href="javascript:NewCal('rec_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr>
      <? if ($show_sun_cust){ echo '
	  <tr>
        <td>* Sunsilks Cust Code</td>
        <td><input type="text" name="sun_cust" value="' . $sun_cust . '" /></td>
      </tr>  
	  ';
	  }
	  ?>
      
	  <? if ($show_sun_cust){ echo '
	  <tr>
        <td>* PO Receive Date</td>
        <td><input type="text" name="po_rec_date" id="po_rec_date" value="' . $po_rec_date . '" /></td>
		<td><a href="javascript:NewCal(\'po_rec_date\',\'ddmmmyyyy\',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr> 
	  ';
	  }
	  ?>          
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="updateBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("edit_order");
 frmvalidator.EnableMsgsTogether(); 
 
 var sortby_po_rec_date = "<?= $sortby_po_rec_date ?>";
 if(sortby_po_rec_date){
    frmvalidator.addValidation("po_rec_date","req","Please enter the PO receive date");
 } else {
    frmvalidator.addValidation("rec_date","req","Please enter the receive date");
 }


</script>
  
  
  </body>
</html>

<? mysql_close($conn); ?>