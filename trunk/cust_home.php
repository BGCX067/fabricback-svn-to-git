<?php

require_once('lib.php');
$curr_cust_user=$_COOKIE["user"]

?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
  </head>
  <body> 
  <h1> Welcome, <? echo $curr_cust_user ?> </h1>
  <table class="box">
      <tr>
        <td colspan="2" class="submitCell">


<button onClick="window.location='order_mgmt.php'" class="btn">Order &amp; Tracking Information</button>

        </td>
      </tr>  
      <tr>
        <td colspan="2" class="submitCell">


<button onClick="window.location='logout.php'" class="btn">Logout</button>

        </td>
      </tr>    
      
            <tr>
        <td colspan="2" class="submitCell">



        </td>
      </tr>      
      
    </table>
</body>
</html>

<? mysql_close($conn); ?>