<?php
require_once('lib.php');

if($_POST['roll_id']){
	$rid=$_POST['roll_id'];
} else {
	$rid=$_GET['rid'];
}

$updateBool=$_POST['updateBool'];
if($updateBool){
	$query = "   INSERT INTO roll_time VALUES ('','$_POST[roll_id]', '$_POST[time_description]', '$_POST[start_or_stop]' , CURRENT_TIMESTAMP, '$_POST[operator]')  ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record updated</echoBox>";
	}

}

$deleteBool=$_GET['delete'];
if($deleteBool){
	$query = " DELETE FROM roll_time  WHERE roll_time.time_id='$_GET[tid]'   ";
	
	if(!mysql_query($query)) {
		echo "<echoBox id='fade'>failed</echoBox>";
	} else {
		echo "<echoBox id='fade'>1 record deleted</echoBox>";
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
			  document.getElementById("fade").style.display='none';
		  }
		  setTimeout("repeat()",20);
		}
	</script>
  </head>
  <body onLoad="repeat();">
  

    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="barcode_reader_time.php" style="color:#FFF">Barcode Reader </a> ---> Edit Timesheet
  </div>
  <!-- /BreadCrumbs -->    
  <br>
  <button style="width:250px; height:50px" onClick="window.location='barcode_reader_time.php'" class="btn" />Scan a new roll</button>

  
  <form action="edit_roll_time.php?rid=<? echo $rid ?>" method="POST" name="edit_roll" >
    <? include('error.php'); ?>
    <h1>
      Update Time Sheet for this roll
    </h1>
    <table class="box">
      <tr>
        <td>
        <select name="time_description">
            <option value="press 1">press 1</option>
            <option value="roll (back)">roll (back)</option>
            <option value="knit back">knit back</option>
            <option value="non woven back">non woven back</option>
            <option value="stain 1">stain 1</option>
            <option value="stain 2">stain 2</option>
            <option value="press 2">press 2</option>
            <option value="press 3">press 3</option>
            <option value="trim/cut">trim/cut</option>
        </select>
        <select name="start_or_stop">
            <option value="start">start</option>
            <option value="stop">stop</option>
        </select>
        <select name="operator">
            <option value="phillip">phillip</option>
            <option value="annabel">annabel</option>
        </select>        
      </tr>
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="roll_id" value="<? echo $rid ?>" />        
          <input type="hidden" name="updateBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
<script language="JavaScript" type="text/javascript">
 var frmvalidator = new Validator("edit_roll");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("username","req","Please enter your username");
 
 frmvalidator.addValidation("firstname","req","Please enter your first name");
 
 frmvalidator.addValidation("lastname","req","Please enter your last name");

 frmvalidator.addValidation("password","req","Please enter your password");
 frmvalidator.addValidation("password","minlength=5");

 
 frmvalidator.addValidation("password_retype","req","Please re-enter your password for verification");


</script>
  

<h1>
      Time sheet history for this roll
</h1> 

<table class="box">
<tr>
<th>Description</th>
<th>Time Stamp</th>
<th>Operator</th>
</tr>


<?
$result = mysql_query("   SELECT * FROM roll_time WHERE roll_time.roll_id = $rid ORDER BY time_timestamp    ");
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['time_description'] . " " . $row['time_start_stop'] . "</td>";
  echo "<td>" . $row['time_timestamp']  . "</td>";
  echo "<td>" . $row['operator']  . "</td>";
  echo "<td><a href=\"edit_roll_time.php?rid=" . $rid . "&delete=true&tid=" . $row['time_id'] . "\">Delete</a></td>";
  
  echo "</tr>";
  }
echo "</table>";

?>
  
  </body>
</html>

<? mysql_close($conn); ?>