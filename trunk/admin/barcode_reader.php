<?php
require_once('lib.php');

$updateBool=$_POST['updateBool'];
if($updateBool){
	$query = "   UPDATE	order_roll SET	order_roll.CUST_ITEM_NUM='$_POST[cust_item_num]', order_roll.SERIAL_NUM='$_POST[serial_num]', order_roll.YARDAGE='$_POST[yardage]', order_roll.PROCESS_DATE=STR_TO_DATE('$_POST[process_date]','%m/%d/%Y'), order_roll.SHIP_DATE=STR_TO_DATE('$_POST[ship_date]','%m/%d/%Y'), order_roll.SERVICE_OPTIONS='$_POST[service_options]', order_roll.TRACKING_NUM='$_POST[tracking_num]' WHERE	order_roll.ROLL_ID='$rid'  ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id='fade'>failed</echoBox>";
	} else {
		echo "<echoBox id='fade'>1 record updated</echoBox>";
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
    <script type="text/javascript">
		var per=1;
		function repeat() {
		  if (per>=0) {
			  document.getElementById("fade").style.opacity=per;
			per-=0.01;
		  }
		  if (per<0){
			 // document.getElementById("fade").style.display='none';
		  }
		  setTimeout("repeat()",10);
		}
	</script>


  </head>
  <body onLoad="document.getElementById('barcodeInput').focus(); repeat();"> 
  
  <form action="edit_roll.php?cid=<? echo $cid; ?>&oid=<? echo $oid; ?>&rid=<? echo $rid ?>" method="POST" name="barcode_form">
    <? include('error.php'); ?>
    <h1>
      SCAN A BARCODE
    </h1>
    <table class="box">
      <tr>
        <td>* Barcode</td>
        <td><input type="text" name="barcode" id="barcodeInput"  /></td>
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="barcodeSubmit" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
  
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("barcode_form");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("barcodeInput","req","Please enter your username");
 frmvalidator.addValidation("barcodeInput","minlength=13");
 frmvalidator.addValidation("barcodeInput","maxlength=13");


</script>
  
  
  </body>
</html>

<? mysql_close($conn); ?>