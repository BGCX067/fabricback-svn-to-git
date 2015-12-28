<? 

require_once('lib.php');

if ($_POST['loginBool']){
	$query=mysql_query("SELECT admin_user.PASSWORD FROM admin_user WHERE admin_user.USERNAME='$_POST[username]'");
	if(mysql_num_rows($query)==1){
		$result=mysql_result($query,0,"PASSWORD");
		if (strtolower($_POST['password'])==strtolower($result) ) {
			setcookie("user", strtolower($_POST['username']), time()+3600);
			header( 'Location: admin_home.php' );
		} else {
			echo "<echoBox id=\"fade\">Unknown username or password. Please try again.</echoBox>";
		}
	} else {
		echo "<echoBox id=\"fade\"> Unknown username or password. Please try again.</echoBox>";
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
    <div style="font-size:12px; color:#FFF"> Not an Administrator? <a href="../index.php" style="color:#FFF"> Click Here! </a> </div>

  <form action="admin_login.php" method="POST" name="loginform">
    <? include('error.php'); ?>
    <h1>
      Login to your Administrator Account
    </h1>
    <table class="box">
      <tr>
        <td>
          * Username
        </td>
        <td>
          <input type="text" name="username" />
        </td>
      </tr>
      <tr>
        <td>
          * Password
        </td>
        <td>
          <input type="password" name="password" />
        </td>
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="loginBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("loginform");
 frmvalidator.EnableMsgsTogether(); 
 frmvalidator.addValidation("username","req","Please enter your username");
 
 frmvalidator.addValidation("password","req","Please enter your password");

</script>

  </body>
</html><? mysql_close($conn); ?>