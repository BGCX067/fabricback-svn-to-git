<?php
require_once('lib.php');


// ------------------------------------------------------------ // 

if ( $_COOKIE['beginDateCookie'] && $_COOKIE['endDateCookie'] && $_COOKIE['userDateCookie']=='timing_report' ){
	
	$beginDate = $_COOKIE['beginDateCookie'];
	$endDate = $_COOKIE['endDateCookie'];
} else {
	$prev_date = mktime(0, 0, 0, date("m"), date("d")-7, date("y")); // DEFAULT: get from 7 days ago
	$beginDateDefault= date("m/d/Y", $prev_date); 
	$today = mktime(0, 0, 0, date("m"), date("d"), date("y"));
	$endDateDefault = date("m/d/Y", $today); 
	
	$beginDate = $beginDateDefault;
	$endDate = $endDateDefault;
}
	
if(  $_POST['beginDatePost'] && $_POST['endDatePost']  ){
	setcookie("beginDateCookie"," ",time()-3600);
	setcookie("endDateCookie"," ",time()-3600);	
	setcookie("userDateCookie"," ",time()-3600);	

	setcookie("beginDateCookie", $_POST['beginDatePost']);
	setcookie("endDateCookie", $_POST['endDatePost']);
	setcookie("userDateCookie", "timing_report");	
	$beginDate = $_POST['beginDatePost']; 
	$endDate = $_POST['endDatePost'];
}

// The above code remembers a date that you set for a specific customer. if no date is set, it resorts to the default

// ------------------------------------------------------------ // 

if ( $_POST['process_chosen'] ){
	$process_chosen = $_POST['process_chosen'];
} else {
	$process_chosen = 'All Processes';
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
  
    <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="admin_home.php" style="color:#FFF">Admin Home Page </a> ---> Timesheet Report 
  </div>
  <!-- /BreadCrumbs -->
    
  <h1>Timesheet Report for <yellow><? echo $process_chosen ?></yellow> from <yellow><? echo $beginDate ?></yellow> to <yellow><? echo $endDate ?></yellow></h1>

  <form action="timing_report.php" method="POST" name="operator_in_view">
    <table class="box">
      <tr>
        <td>* Select a Process</td>
        <td>
        <select name="process_chosen">
        <option value="All Processes">All Processes</option>
        
<?     
$process_query = mysql_query(" SELECT DISTINCT roll_time.time_description FROM roll_time  ");
while($row_process = mysql_fetch_array($process_query)){
	if ($row_process['time_description'] == $process_chosen){
	    echo '<option  selected  value="' . $row_process['time_description'] . '">' . $row_process['time_description'] . '</option>' ; 
	} else {
	    echo '<option value="' . $row_process['time_description'] . '">' . $row_process['time_description'] . '</option>' ; 
	}
}
?>

		</select>
        
        
        </td>
        <td><input type="Submit" class="btn_small" /></td>

      </tr>      
    </table>
    </form>    

  <form action="timing_report.php" method="POST" name="change_dates">
    <? include('error.php'); ?>
    <table class="box">
      <tr>
        <td>* Start Date</td>
        <td><input type="text" name="beginDatePost" id="beginDate" value="<? echo $beginDate ?>" /></td>
        <td><a href="javascript:NewCal('beginDate','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
        <td>* End Date</td>
        <td><input type="text" name="endDatePost" id="endDate" value="<? echo $endDate ?>" /></td>
        <td><a href="javascript:NewCal('endDate','ddmmmyyyy',true,12)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
        <td><input type="Submit" value="Change Dates" class="btn_small" /></td>
      </tr>      
    </table>
    </form>     


  

<table class="box" style="font-size: 12px;">


<?
if($process_chosen == 'All Processes'){
$result = mysql_query("SELECT DISTINCT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM  FROM cust_order NATURAL JOIN cust_user NATURAL JOIN order_roll NATURAL JOIN roll_time WHERE PROCESS_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY PROCESS_DATE DESC, USERNAME, ROLL_ID  ");
} else {
$result = mysql_query("SELECT DISTINCT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM, DATE_FORMAT(PROCESS_DATE, '%m/%d/%Y') AS PROCESS_DATE_FORM, DATE_FORMAT(SHIP_DATE, '%m/%d/%Y') AS SHIP_DATE_FORM  FROM cust_order NATURAL JOIN cust_user NATURAL JOIN order_roll NATURAL JOIN roll_time WHERE time_description = '$process_chosen' AND PROCESS_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY PROCESS_DATE DESC, USERNAME, ROLL_ID  ");
}

echo "<tr>";
echo "<th>Process Date</th>";
echo "<th>Customer</th>";
if($view_ids){ echo '<th>Order ID</th>'; } 
//echo "<th>Receive Date</th>";
//echo "<th>Customer PO Num</th>";
echo "<th>Sunsilks Invoice Num</th>";
if($view_ids){ echo '<th>Roll ID</th>'; }
echo "<th>Description</th>";
//echo "<th>Cust Item Num</th>";
echo "<th>Serial Num</th>";
echo "<th>Yardage</th>";
//echo "<th>Ship Date</th>";
echo "<th>Process</th>";
echo "<th>Operator 1</th>";
echo "<th>Operator 2</th>";
echo "<th>Time</th>";

//echo "<th>Tracking Number</th>";
echo "</tr>";
echo "<tr><td colspan=20><hr></td></tr>";


$i=0; // number of rolls
$yard = 0; // sum of all the yardage
$time = 0 ; // sum of all the times

while($row = mysql_fetch_array($result))
  {	  
   
  
  echo "<tr>";
  echo "<td>" . $row['PROCESS_DATE_FORM'] . "</td>";  
  echo "<td>" . $row['USERNAME'] . "</td>";  
  if($view_ids){  echo "<td>" . $row['ORDER_ID'] . "</td>";   }
 // echo "<td>" . $row['REC_DATE_FORM'] . "</td>";
 // echo "<td>" . $row['CUST_PO_NUM'] . "</td>";
  echo "<td>" . $row['INVOICE_NUM'] . "</td>";
  if($view_ids){  echo "<td>" . $row['ROLL_ID'] . "</td>";   }
//  echo "<td>" . $row['CUST_ITEM_NUM'] . "</td>";

  echo "<td>";
  if($row['TYPE_SILK']){ echo "silk "; }
  if($row['TYPE_EMBR']){ echo "embroidered "; }   
  if($row['TYPE_VELVET']){ echo "velvet "; } 
  if($row['TYPE_SPECIAL']){ echo "special "; } 
  if(!$row['TYPE_SILK'] && !$row['TYPE_EMBR'] && !$row['TYPE_VELVET'] && !$row['TYPE_SPECIAL']){ echo "no properties specified" ; }
  echo "</td>";
  
  echo "<td>" . $row['SERIAL_NUM'] . "</td>";
  echo "<td>" . $row['YARDAGE'] . "</td>";
 // echo "<td>" . $row['SHIP_DATE_FORM'] . "</td>";
  echo "<td>" . $row['time_description'] . "</td>";
  echo "<td>" . $row['operator'] . "</td>";  
  echo "<td>" . $row['operator2'] . "</td>";    
  
  
  
  
  $startPeice = explode(".",$row['time_start']);
  if($startPeice[0] <= 7){
	  $startPeice[0] = $startPeice[0] + 12; // logic: if less than 7 add 12 to it. business hours are 7 AM to 6 PM
  }
  $beginTime = $startPeice[0]*60 + $startPeice[1];
  
  $endPeice = explode(".",$row['time_stop']);
  if($endPeice[0] <= 7){
	  $endPeice[0] = $endPeice[0] + 12;
  }  
  $endTime = $endPeice[0]*60 + $endPeice[1]; 
  
  $totalTime[$i] =$endTime-$beginTime;
  echo "<td>" . $totalTime[$i]  . "</td>";
  
  $time=$totalTime[$i]+$time;
  $yard=$row['YARDAGE']+$yard;
  $i=$i+1;
  
  echo "<td><a href=\"javascript:void(0);\"  onclick=\"window.open('edit_roll_timesheet.php?rid=".$row['ROLL_ID']."&view_id=1&serial_num=".$row['SERIAL_NUM']."','_blank','height=600 , width=1200 , resizable=1, scrollbars=1')\">Edit Time Sheet</a></td>";  

  
 // if($row['TRACKING_NUM']=="1ZY81E65"){ echo "<td></td>"; } else { echo '<td>' . $row['TRACKING_NUM'] . '</td>'; }
  echo "</tr>";

  echo "<tr><td colspan=20><hr></td></tr>";

  }
echo "</table>";


$timeperprocess=$time/$i;
echo "<table class='box'>";
echo "<tr>";
	echo "<td><b>Number of Processes:</b></td>";
	echo "<td>".$i."</td>";
	echo "<td><b>Total Time:</b></td>";
	echo "<td>".$time."</td>";
	echo "<td><b>Total Yardage:</b></td>";
	echo "<td>".$yard."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td><b>Avg Time Per Process:</b></td>";
	echo "<td>".round($timeperprocess,2)." min</td>";
echo "</tr>";
echo "</table>";


?>

<?
    //  echo "<button class=\"btn\" href=\"javascript:void(0);\" onclick=\" javascript: printAll(); \">** PRINT ALL SLIPS IN CURRENT VIEW **</button>";
?>

<script>
function printSelection(cid,oid,rid){
	
	var winLink = 'print_roll_slip.php?cid='+cid+'&oid='+oid+'&rid='+rid;
	// alert(winLink);
  	var pwin=window.open(winLink,'print_content','width=800,height=500');
	
	return false;

}

function printAll(){
	var startDate = <?= json_encode($beginDate) ?>;
	var endDate = <?= json_encode($endDate) ?>;
	//alert(startDate + " " + endDate);
	var winLink = 'print_all.php?beginDate='+startDate+'&endDate='+endDate;
  	var pwin=window.open(winLink,'print_content','width=800,height=500');

	
}
</script>
  </body>
</html>

<? mysql_close($conn); ?>