<?php
require_once('lib.php');

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
  <body onLoad="document.getElementById('barcodeInput').focus(); repeat();"> 

    <? include('error.php'); ?>

    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> Timesheet Update
  </div>
  <!-- /BreadCrumbs -->  
  
  <form action="edit_roll_timesheet.php" method="POST" name="barcode_form">
    <h1>
      Edit a Timesheet
    </h1>
    <table class="box">
      <tr>
        <td>* Serial Number</td>
        <td><input type="text" name="serial_num" id="barcodeInput"  /></td>
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
 
 //frmvalidator.addValidation("barcodeInput","req","Please enter a correct barcode");
 //frmvalidator.addValidation("barcodeInput","minlength=13");
 //frmvalidator.addValidation("barcodeInput","maxlength=13");


</script>
  
  
  </body>
</html>

<? mysql_close($conn); ?>