<?php

require_once('lib.php');
$curr_admin_user=$_COOKIE["user"];


?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
  </head>
  <body> 
  <h1> Welcome, <? echo ucfirst($curr_admin_user) ?> </h1>
  <table class="box">

	<? if($edit_user){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'edit_password.php\'" class="btn">Change your password</button></td></tr>' ; } ?>
    <? if($test_mode){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.open (\'barcode_reader.php\', \'width=50%\', \'height=1000px\')" class="btn">Barcode Reader</button></td></tr>' ; } ?>
    <? if($display_neutral){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'timesheet_update.php\'" class="btn">Timesheet Update</button></td></tr>' ; } ?>
    <? if($display_neutral){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'timing_report.php\'" class="btn">Timesheet Report **NEW**</button></td></tr>' ; } ?>
    <? if($display_neutral){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'cust_mgmt.php\'" class="btn">Customer Management</button></td></tr>' ; } ?>
    <? if($display_neutral){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'backup_view.php\'" class="btn">View All Orders For All Customers</button></td></tr>' ; } ?>
    <? if($display_neutral){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.open (\'backup/backup.php\', \'width=200px\', \'height=100px\')" class="btn">Database Backup</button></td></tr>' ; } ?>
    <? if(true){  echo '<tr><td colspan="2" class="submitCell"><button onClick="window.location=\'logout.php\'" class="btn">Logout</button></td></tr>' ; } ?>

	<tr><td>&nbsp;</td></tr>
    
    </table>
</body>
</html>

<? mysql_close($conn); ?>