<?php
require_once('lib.php');


$cid=$_GET['cid'];
$query=" SELECT * FROM cust_user WHERE CUST_ID='$cid' ";
$result=mysql_query($query);

$username=mysql_result($result,$i,"USERNAME");
$password=mysql_result($result,$i,"PASSWORD");

?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
    <script language="JavaScript" src="../gen_validatorv31.js" type="text/javascript"></script>    
  </head>
  <body> 
  
  
    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="cust_mgmt.php" style="color:#FFF">Customer Management </a> ---> Edit Customer Information
  </div>
  <!-- /BreadCrumbs -->
  
  
  <form action="cust_mgmt.php" method="POST" name="edit_cust">
    <? include('error.php'); ?>
    <h1>
      Update a Customer Account
    </h1>
    <table class="box">
      <tr>
        <td>* Username</td>
        <td><input type="text" name="username" value="<? echo $username ?>"  /></td>
      </tr>
      <tr>
        <td>
          * New password
        </td>
        <td>
          <input type="text" name="password"  value="<? echo $password ?>" />
        </td>
      </tr>
      <tr>
        <td>
          * Re-enter new password
        </td>
        <td>
          <input type="text" name="password_retype" value="<? echo $password ?>" />
        </td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="updateBool" value="true" />
          <input type="hidden" name="id" value="<? echo $cid ?>" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("edit_cust");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("username","req","Please enter your username");

 frmvalidator.addValidation("password","req","Please enter your password");
 frmvalidator.addValidation("password","minlength=5");

 
 frmvalidator.addValidation("password_retype","req","Please re-enter your password for verification");


</script>
  
  
  </body>
</html>

<? mysql_close($conn); ?>