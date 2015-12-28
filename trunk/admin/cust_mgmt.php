<?php
require_once('lib.php');

$id=$_POST['id'];
$updateBool=$_POST['updateBool'];
if($updateBool && $_POST['password']==$_POST['password_retype']){
	$query = "   UPDATE	cust_user SET	cust_user.USERNAME='$_POST[username]', cust_user.PASSWORD='$_POST[password]' WHERE	cust_user.CUST_ID='$_POST[id]'  ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record updated</echoBox>";
	}

}

$addBool=$_POST['addBool'];
if($addBool && $_POST['password']==$_POST['password_retype']){
	
	$username=$_POST['username'];
	$pass=$_POST['password'];
	
	$query = "    INSERT INTO  	cust_user VALUES ('','$username','$pass', '99')";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record added</echoBox>";
	}
	
}


$did=$_GET['did'];
if($did!=''){
	$query = "  DELETE FROM cust_user  WHERE cust_user.CUST_ID='$did'   ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">user deleted</echoBox>";
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
  </head>
  <body>
  
  <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> Customer Management
  </div>
  <!-- /BreadCrumbs -->

<h1>
      Customer Account Management
</h1>

<table class='box'>
<tr> 
<? if($view_ids){ echo '<th>Customer ID</th>'; } ?>
<th>Username</th> 
 </tr>

<?
$result = mysql_query("SELECT * FROM cust_user");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  if($view_ids){  echo "<td>" . $row['CUST_ID'] . "</td>";   }
  echo "<td>" . $row['USERNAME'] . "</td>";
  echo "<td><a href=\"edit_customer.php?cid=" . $row['CUST_ID'] . "\">Modify Customer</a></td>";
  echo "<td><a href=\"order_mgmt.php?cid=" . $row['CUST_ID'] . "\">View Orders for this customer</a></td>";
  echo "<td><a href=\"cust_mgmt.php?did=" . $row['CUST_ID'] . "\" onclick=\"return confirm('Are you sure you want to delete this entry?')\">Delete Customer</a></td>";
  echo "</tr>";
  }
echo "</table>";

?>
  
  
  <form action="cust_mgmt.php" method="POST" name="create_cust">
    <? include('error.php'); ?>
    <h1>
      Create an Customer Account
    </h1>
    <table class="box">
      <tr>
        <td>* Username</td>
        <td><input type="text" name="username" /></td>
      </tr>
      <tr>
        <td>
          * Choose a password
        </td>
        <td>
          <input type="text" name="password" />
        </td>
      </tr>
      <tr>
        <td>
          * Re-enter password
        </td>
        <td>
          <input type="text" name="password_retype" />
          <input type="hidden" name="addBool" value="true">
        </td>
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("create_cust");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("username","req","Please enter your username");

 frmvalidator.addValidation("password","req","Please enter your password");
 frmvalidator.addValidation("password","minlength=5");

 
 frmvalidator.addValidation("password_retype","req","Please re-enter your password for verification");


</script>



  </body>
</html>

<? mysql_close($conn); ?>