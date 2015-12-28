<? 

require_once('lib.php'); 

if ($_POST['loginBool']){
	$username = strtolower($_POST['username']);
	$sun_cust = strtolower($_POST['sun_cust']);	
	$query=mysql_query("SELECT cust_user.PASSWORD FROM cust_user WHERE cust_user.USERNAME='$username'");
	if(mysql_num_rows($query)==1){
		$result=mysql_result($query,0,"PASSWORD");
		if (strtolower($_POST['password'])==strtolower($result) ) {	
			setcookie("user", $_POST['username'], time()-36000);
			setcookie("user", strtolower($_POST['username']), time()+3600);
				$query2=mysql_query("SELECT cust_order.SUN_CUST FROM cust_order WHERE cust_order.SUN_CUST='$sun_cust'");
				if(mysql_num_rows($query2)>=1){
					setcookie("sun_cust_code_input", $sun_cust, time()-36000);
					setcookie("sun_cust_code_input", $sun_cust, time()+3600);
					header( 'Location: order_mgmt.php' ) ;
				} else {
					echo "<echoBox id=\"fade\">Unknown Customer Code. Please try again.</echoBox>";
				}			
		} else {
			echo "<echoBox id=\"fade\">Unknown username or password. Please try again.</echoBox>";
		}
	} else {
		echo "<echoBox id=\"fade\">Unknown username or password. Please try again.</echoBox>";
	}

		


	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
    <script language="JavaScript" src="gen_validatorv31.js" type="text/javascript"></script>
  </head>
  <body> 
    <div style="font-size:12px; color:#FFF"> Don't have a username or password? <a href="index.php" style="color:#FFF"> Click Here! </a> </div>

  <form action="cust_login.php" method="POST" name="loginform">
    <? include('error.php'); ?>
    <h1>
      Login to your Customer Account
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
        <td>
          * Sunsilks Customer Code
        </td>
        <td>
          <input type="text" name="sun_cust" />
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