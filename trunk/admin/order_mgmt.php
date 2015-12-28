<?php
require_once('lib.php');

// ------------------------------------------------------------ // 

if ( $_COOKIE['beginDateCookie'] && $_COOKIE['endDateCookie'] && $_COOKIE['userDateCookie']==$cid ){
	
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
	setcookie("userDateCookie", $cid);	
	$beginDate = $_POST['beginDatePost']; 
	$endDate = $_POST['endDatePost'];
}

// The above code remembers a date that you set for a specific customer. if no date is set, it resorts to the default

// ------------------------------------------------------------ // 

$cid=$_GET['cid'];
$oid=$_GET['oid'];


$queryIdentifier=mysql_query("SELECT cust_user.USERNAME FROM cust_user WHERE cust_user.CUST_ID='$cid'");
$resultIdentifier=mysql_result($queryIdentifier,0,"USERNAME");

if($resultIdentifier == 'GASUIN'){
	$show_sun_cust = true;
	$show_po_rec_date = true;
	$sortby_po_rec_date = true;
}



$addBool=$_POST['addBool'];
if($addBool){
	
	$invoice_num=$_POST['invoice_num'];
	$rec_date=$_POST['rec_date'];
	$cust_po_num=$_POST['cust_po_num'];
	$sun_cust=$_POST['sun_cust'];
	$po_rec_date=$_POST['po_rec_date'];
	
	$query = "    INSERT INTO cust_order VALUES ('','$sun_cust', STR_TO_DATE('$po_rec_date','%m/%d/%Y'), '$invoice_num',STR_TO_DATE('$rec_date','%m/%d/%Y'), '$cust_po_num' , '$cid', CURRENT_TIMESTAMP)          ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record added</echoBox>";
	}

}

$updateBool=$_POST['updateBool'];
if($updateBool){

	$invoice_num=$_POST['invoice_num'];
	$rec_date=$_POST['rec_date'];
	$cust_po_num=$_POST['cust_po_num'];
	$sun_cust=$_POST['sun_cust'];
	$po_rec_date=$_POST['po_rec_date'];
	
	$query = "   UPDATE	cust_order SET	cust_order.INVOICE_NUM='$_POST[invoice_num]', cust_order.REC_DATE=STR_TO_DATE('$_POST[rec_date]','%m/%d/%Y'), cust_order.PO_REC_DATE=STR_TO_DATE('$_POST[po_rec_date]','%m/%d/%Y'), cust_order.CUST_PO_NUM='$_POST[cust_po_num]' , cust_order.SUN_CUST='$_POST[sun_cust]' WHERE	cust_order.ORDER_ID='$oid'  ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record updated</echoBox>";
	}

}

$did=$_GET['did'];
if($did!=''){
	$query = "  DELETE FROM cust_order  WHERE cust_order.ORDER_ID='$did'   ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">order deleted</echoBox>";
	}
	

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
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="cust_mgmt.php" style="color:#FFF">Customer Management </a> ---> Order Management
  </div>
  <!-- /BreadCrumbs -->


  <form action="order_mgmt.php?cid=<? echo $cid; ?>" method="POST" name="create_order">
    <? include('error.php'); ?>
    <h1>
      Create an New Order for the Customer <yellow><? echo $resultIdentifier ?> </yellow>
    </h1>
    <table class="box">
      <tr>
        <td>* Customer PO Num</td>
        <td><input type="text" name="cust_po_num" /></td>
      </tr>    
      <? if ($show_sun_cust){ echo '
	  <tr>
        <td>* Sunsilks Customer Code</td>
        <td><input type="text" name="sun_cust" /></td>
      </tr>  
	  ';
	  }
	  ?>
      
	  <? if ($show_sun_cust){ echo '
	  <tr>
        <td>* PO Receive Date</td>
        <td><input type="text" name="po_rec_date" id="po_rec_date" /></td>
		<td><a href="javascript:NewCal(\'po_rec_date\',\'ddmmmyyyy\',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      </tr> 
	  ';
	  }
	  ?>      
      <tr>
        <td>* Sunsilks Invoice Num</td>
        <td><input type="text" name="invoice_num" /></td>
      </tr>
      <tr>
        <td>
          * Receive Date
        </td>
        <td>
          <input type="text" name="rec_date" id="rec_date" />
        </td>
        <td><a href="javascript:NewCal('rec_date','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>

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
 var frmvalidator = new Validator("create_order");
 frmvalidator.EnableMsgsTogether(); 
 
 var sortby_po_rec_date = "<?= $sortby_po_rec_date ?>";
 if(sortby_po_rec_date){
    frmvalidator.addValidation("po_rec_date","req","Please enter the PO receive date");
 } else {
    frmvalidator.addValidation("rec_date","req","Please enter the receive date");
 }

</script>    
    


    <h1>
      All Orders for the Customer <yellow><? echo $resultIdentifier ?></yellow> from <yellow><? echo $beginDate ?> to <? echo $endDate ?>
    </h1>
    
  <form action="order_mgmt.php?cid=<? echo $cid; ?>" method="POST" name="change_dates">
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
    
<table class='box'>
<tr>
<? if($view_ids){ echo '<th>Order ID</th>'; } ?>
<? if ($show_po_rec_date){ echo "<th>PO Receive Date</th>"; } ?>
<? if ($show_sun_cust){ echo "<th>Sunsilks Cust Code</th>"; } ?>
<th>Receive Date</th>
<th>Customer PO Num</th>
<th>Sunsilks Invoice Num</th>
<th># of Rolls [ yds ]</th>
</tr>

<?
if($sortby_po_rec_date){
$result = mysql_query("SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PO_REC_DATE, '%m/%d/%Y') AS PO_REC_DATE_FORM FROM cust_order WHERE cust_order.CUST_ID='$cid' AND PO_REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y')  ORDER BY cust_order.PO_REC_DATE DESC, cust_order.REC_DATE DESC");
} else {
$result = mysql_query("SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PO_REC_DATE, '%m/%d/%Y') AS PO_REC_DATE_FORM FROM cust_order WHERE cust_order.CUST_ID='$cid' AND REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y')  ORDER BY cust_order.REC_DATE DESC");
}
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  if($view_ids){  echo "<td>" . $row['ORDER_ID'] . "</td>";   }
  if ($show_po_rec_date){ echo "<td>" . $row['PO_REC_DATE_FORM'] . "</td>" ; }   
  if ($show_sun_cust){ echo "<td>" . $row['SUN_CUST'] . "</td>" ; }     
  echo "<td>" . $row['REC_DATE_FORM'] . "</td>";    
  echo "<td>" . $row['CUST_PO_NUM'] . "</td>";
  echo "<td>" . $row['INVOICE_NUM'] . "</td>";
  
  $resultYardage = mysql_query("SELECT * FROM cust_order NATURAL JOIN order_roll WHERE cust_order.ORDER_ID='$row[ORDER_ID]'");
  echo "<td>" . mysql_num_rows($resultYardage) . " [";
  while($row2 = mysql_fetch_array($resultYardage))
  {
	 echo " " . $row2['YARDAGE'] . " ";
  }
  echo "]</td>";
	  
  echo "<td><a href=\"edit_order.php?cid=" . $row['CUST_ID'] . "&oid=" . $row['ORDER_ID'] . "\">Modify Order</a></td>";
  echo "<td><a href=\"roll_mgmt.php?cid=" . $row['CUST_ID'] . "&oid=" . $row['ORDER_ID'] . "\">View Rolls in this order</a></td>";
  echo "<td><a href=\"order_mgmt.php?cid=" . $row['CUST_ID'] . "&oid=" . $row['ORDER_ID'] . "&did=" . $row['ORDER_ID'] . "\" onclick=\"return confirm('Are you sure you want to delete this entry?')\">Delete Order</a></td>";
  echo "</tr>";
  }
echo "</table>";

?>
  

  </body>
</html>

<? mysql_close($conn); ?>