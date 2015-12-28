<?php

require_once('lib.php');

$admin_username=$_COOKIE["user"];
if($_POST['updatePassBool']){
if ($_POST['password_new']==$_POST['password_retype'] && $_POST['password_old']==mysql_result(mysql_query("SELECT admin_user.PASSWORD FROM admin_user WHERE admin_user.USERNAME='$admin_username'"),0,"PASSWORD") ){
																													   
	$query = "   UPDATE	admin_user SET	admin_user.PASSWORD='$_POST[password_new]' WHERE	admin_user.USERNAME='$admin_username'  ";
	
	if(!mysql_query($query)) {
			echo "<echoBox>failed</echoBox>";
		} else {
			echo "<echoBox>you have changed your password</echoBox>";
		}
		
} else {
	echo "<echoBox>failed.  you may have not entered your old password correctly</echoBox>";
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
    <script language="javascript" type="text/javascript">
	function DoCustomValidation()
	{
	  var frm = document.forms["changePass"];
	  if(frm.password_new.value != frm.password_retype.value)
	  {
		sfm_show_error_msg('The new password and re-enter password do not match!',frm.password_new);
		return false;
	  }
	  else
	  {
		return true;
	  }
	}
</script>   
  </head>
  <body> 
  
    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> Change your password
  </div>
  <!-- /BreadCrumbs -->
  
  
  <form action="edit_password.php" method="POST" name="changePass">
    <? include('error.php'); ?>
    <h1>
      Edit your administrator password
    </h1>
    <table class="box">
      <tr>
        <td>
          * Old password
        </td>
        <td>
          <input type="password" name="password_old" />
        </td>
      </tr>
      <tr>
        <td>
          * New password
        </td>
        <td>
          <input type="password" name="password_new" />
        </td>
      </tr>
      <tr>
        <td>
          * Re-enter new password
        </td>
        <td>
          <input type="password" name="password_retype" />
        </td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="updatePassBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("changePass");
 frmvalidator.EnableMsgsTogether(); 
 frmvalidator.addValidation("password_old","req","Please enter your old password");
 
 frmvalidator.addValidation("password_new","req","Please enter your new password");
 frmvalidator.addValidation("password_new","minlen=5","Min length for Password is 5"); 
 
 frmvalidator.addValidation("password_retype","req","Please retype your new password");


 frmvalidator.setAddnlValidationFunction("DoCustomValidation"); 

</script>

  
</body>
</html>

<? mysql_close($conn); ?>