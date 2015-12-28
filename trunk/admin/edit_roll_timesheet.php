<?php
require_once('lib.php');


if($_POST['serial_num']){
	$serial_number = $_POST['serial_num'];
	$queryIdentifyRoll=mysql_query("SELECT order_roll.ROLL_ID FROM order_roll WHERE order_roll.SERIAL_NUM='$serial_number'  ");
	$rid=mysql_result($queryIdentifyRoll,0,"ROLL_ID");
} else {
	$rid= $_GET['rid'];
	$serial_num = $_GET['serial_num'];
}

if(!$rid){
	header( 'Location: timesheet_update.php?error=Serial Number not found' ) ;
}


$updateBool=$_POST['updateBool'];
if($updateBool){
	$query = "INSERT INTO roll_time VALUES ('','$_POST[roll_id]', '$_POST[time_description]', '$_POST[time_start]' , '$_POST[time_stop]' , CURRENT_TIMESTAMP, '$_POST[operator]', '$_POST[operator2]')";
	
	if(!mysql_query($query)) {
		echo "<echoBox id=\"fade\">failed</echoBox>";
	} else {
		echo "<echoBox id=\"fade\">1 record updated</echoBox>";
	}

}

$updateBoolType=$_POST['updateTypeBool'];
if($updateBoolType){
	$query = "   UPDATE order_roll SET order_roll.TYPE_SILK='$_POST[fabric_silk]', order_roll.TYPE_EMBR='$_POST[fabric_embroidered]', order_roll.TYPE_VELVET='$_POST[fabric_velvet]' , order_roll.TYPE_SPECIAL='$_POST[fabric_special]' WHERE order_roll.ROLL_ID = $rid   ";
	
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
  </head>
  <body>
  
    <? include('error.php'); ?>

<?
if($_GET['view_id']!=1){
	echo '<!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> <a href="timesheet_update.php" style="color:#FFF">Timesheet Update </a> ---> Edit Timesheet
  </div>
  <!-- /BreadCrumbs -->    
  <br>
  ';
}
?>

<?
$result2 = mysql_query("   SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM FROM order_roll NATURAL JOIN cust_order NATURAL JOIN cust_user WHERE roll_ID='$rid'   ");
$fabric_silk=mysql_result($result2,0,"TYPE_SILK");
$fabric_embr=mysql_result($result2,0,"TYPE_EMBR");
$fabric_velvet=mysql_result($result2,0,"TYPE_VELVET");
$fabric_special=mysql_result($result2,0,"TYPE_SPECIAL");

$cust_username=mysql_result($result2,$i,"USERNAME");
$cust_po_num=mysql_result($result2,$i,"CUST_PO_NUM");
$cust_item_num=mysql_result($result2,$i,"CUST_ITEM_NUM");
$serial_num=mysql_result($result2,$i,"SERIAL_NUM");
$yardage=mysql_result($result2,$i,"YARDAGE");
$receive_date=mysql_result($result2,$i,"REC_DATE_FORM");
$service_options=mysql_result($result2,$i,"SERVICE_OPTIONS");

?>
<table align="center">
<tr>
<td style="padding-right:50px;">

<table class="box" style="font-size:15px;">
  <tr nowrap>
    <td>Cust: </td>
    <td>Cust PO: </td>    
    <td>Cust Item: </td>       
    <td>Serial: </td>      
    <td>Yardage: </td>
    <td>Rec Date: </td>
    <td>Services: </td>      
  </tr> 
  <tr>    
    <td><b><? echo $cust_username ?></b></td>
    <td><b><? echo $cust_po_num ?></b></td>    
    <td><b><? echo $cust_item_num ?></b></td> 
    <td><b><?   if(     strlen($serial_num) >2     ) {echo $serial_num ; } else { echo $serial_num . $rid ;} ?></b></td>  
    <td><b><? echo $yardage; ?></b></td>  
    <td><b><? echo $receive_date; ?></b></td>  
    <td><b><? echo $service_options; ?></b></td> 
  </tr>
</table>   

</td>
<td style="padding-top:10px;">
<?
if($_GET['view_id']!=1){
	echo '<button style="width:250px; height:100px" onClick="window.location=\'timesheet_update.php\'" class="btn" />Go to a new roll</button>';
}
?>
</td>
</tr>
</table>

<table align="center">
<tr>
<td style="padding-right:50px;">
    <form action="edit_roll_timesheet.php?rid=<? echo $rid;?>&serial_num=<? echo $serial_num; ?>" method="POST" name="edit_roll" >
    <h1>
      Current Properties of this Roll:
    </h1>
    <table class="box">
        <tr><td>      
          <? if($fabric_silk){ echo "silk "; } ?>
          <? if($fabric_embr){ echo "embroidered "; } ?>      
          <? if($fabric_velvet){ echo "velvet "; } ?>      
          <? if($fabric_special){ echo "special "; } ?> 
          <? if(!$fabric_silk && !$fabric_embr && !$fabric_velvet && !$fabric_special){ echo "no properties specified" ; } ?>
        </td></tr>
    </table>
    <table class="box">
      <tr>
        <td>Silk</td>
        <td>
         <input type="checkbox" name="fabric_silk" value="true"  <? if($fabric_silk){ echo "checked "; } ?> />
        </td>
      </tr>
      <tr>
        <td>Embroidered</td>
        <td>
         <input type="checkbox" name="fabric_embroidered" value="true" <? if($fabric_embr){ echo "checked "; } ?>  />
        </td>
      </tr>
      <tr>
        <td>Velvet</td>
        <td>
         <input type="checkbox" name="fabric_velvet" value="true" <? if($fabric_velvet){ echo "checked "; } ?>   />
        </td>
      </tr> 
      <tr>
        <td>Special</td>
        <td>
         <input type="checkbox" name="fabric_special" value="true" <? if($fabric_special){ echo "checked "; } ?>  />
        </td>
      </tr>           
      <tr>
        <td colspan="2" class="submitCell">
          <input type="hidden" name="roll_id" value="<? echo $rid ?>" />        
          <input type="hidden" name="updateTypeBool" value="true" />
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>
  
</td>
<td>  
  <form action="edit_roll_timesheet.php?rid=<? echo $rid;?>&serial_num=<? echo $serial_num; ?>" method="POST" name="edit_timesheet" >
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
            <option value="brush">brush</option>            
            <option value="press 2">press 2</option>
            <option value="press 3">press 3</option>
            <option value="trim/cut">trim/cut</option>
        </select>
        &nbsp;Start:&nbsp;
        <input type="text" name="time_start" style="width:50px" /> 
        &nbsp;Stop:&nbsp;
        <input type="text" name="time_stop" style="width:50px" />       
        <select name="operator">
            <option value="felipe">felipe</option>
            <option value="anabel">anabel</option>
            <option value="edith">edith</option>
            <option value="martina">martina</option>
        </select>   
        <select name="operator2">
            <option value=""></option>        
            <option value="felipe">felipe</option>
            <option value="anabel">anabel</option>
            <option value="edith">edith</option>
            <option value="martina">martina</option>
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
 
 var frmvalidator = new Validator("edit_timesheet");
 frmvalidator.EnableMsgsTogether(); 
 
 frmvalidator.addValidation("time_start","req","Please enter a start time");
 frmvalidator.addValidation("time_start","minlength=4");
 frmvalidator.addValidation("time_start","maxlength=5");
 
 frmvalidator.addValidation("time_stop","req","Please enter a stop time");
 frmvalidator.addValidation("time_stop","minlength=4");
 frmvalidator.addValidation("time_stop","maxlength=5");
 
</script>


<h1>
      Time sheet history for this roll
</h1> 

<table class="box">
<tr>
<th>Operation</th>
<th>Start</th>
<th>Stop</th>
<th>Total</th>
<th>Operator</th>
<th>Operator2</th>
</tr>


<?
$result = mysql_query("   SELECT * FROM roll_time WHERE roll_time.roll_id = $rid ORDER BY time_timestamp    ");
$i=0;
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['time_description'] . " " . $row['time_start_stop'] . "</td>";
  echo "<td>" . $row['time_start']  . "</td>";
  echo "<td>" . $row['time_stop']  . "</td>";  
  
  $startPeice = explode(".",$row['time_start']);
  if($startPeice[0] <= 7){
	  $startPeice[0] = $startPeice[0] + 12; // logic: if less than 7 add 12 to it. business hours are 8 AM to 7 PM
  }
  $beginTime = $startPeice[0]*60 + $startPeice[1];
  
  $endPeice = explode(".",$row['time_stop']);
  if($endPeice[0] <= 7){
	  $endPeice[0] = $endPeice[0] + 12;
  }  
  $endTime = $endPeice[0]*60 + $endPeice[1]; 
  
  $totalTime[$i] =$endTime-$beginTime;
  echo "<td>" . $totalTime[$i]  . "</td>";
  
  $i = $i+1;
  
  echo "<td>" . $row['operator']  . "</td>";
  echo "<td>" . $row['operator2']  . "</td>";  
  echo "<td><a href=\"edit_roll_timesheet.php?rid=" . $rid . "&delete=true&tid=" . $row['time_id'] . "\">Delete</a></td>";
  
  echo "</tr>";
  }

$sumTime=0;
for ($x=0; $x<=$i; $x=$x+1){
	$sumTime=$totalTime[$x]+$sumTime;
}

echo "<tr><td><b>Total Time: " . $sumTime . " minutes</b></td></tr>";
echo "</table>";

?>

</td>
</tr>
</table>


  
  </body>
</html>

<? mysql_close($conn); ?>