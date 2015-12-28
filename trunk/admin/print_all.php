<?php
require_once('lib.php');

$cid=$_GET['cid'];
$oid=$_GET['oid'];
$rid=$_GET['rid'];

$beginDate = $_GET['beginDate'];
$endDate = $_GET['endDate'];


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

<?
$query=" SELECT DISTINCT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM FROM order_roll NATURAL JOIN cust_order NATURAL JOIN cust_user WHERE REC_DATE BETWEEN STR_TO_DATE('$beginDate','%m/%d/%Y') AND STR_TO_DATE('$endDate','%m/%d/%Y') ORDER BY USERNAME ASC, CUST_PO_NUM ASC, REC_DATE DESC ";
$result=mysql_query($query);
$num_rows= mysql_num_rows ( $result );



$curr_row = 0;

while($row = mysql_fetch_array($result))
{

	
// code for left side	
echo "<div> <!-- Top level div --><div style=\"float:left\"> <!-- Left level div --><table class=\"box\" style=\"font-size:12px; width:150px;\"><tr>";
echo "<td><b>" . $row['USERNAME'] ."</b></td>";
echo "</tr><tr><td>Cust PO No: </td></tr><tr>";
echo "<td><b>" . $row['CUST_PO_NUM'] . "</b></td>"; 
echo "</tr><tr><td>Cust Item: </td></tr><tr>";
echo "<td><b>" . $row['CUST_ITEM_NUM'] . "</b></td>";
echo "</tr><tr><td>Serial: </td>  </tr><tr>";
echo "<td><b>" . $row['SERIAL_NUM'] . "</b></td>";
echo "</tr><tr><td>Yardage: </td></tr><tr>";
echo "<td><b>" . $row['YARDAGE'] . "</b></td>"; 
echo "</tr><tr><td>Rec Date: </td></tr><tr>";
echo "<td><b>" . $row['REC_DATE_FORM'] .  "</b></td>";
echo "</tr><tr><td>Services: </td></tr><tr>";
echo "<td><b>" . $row['SERVICE_OPTIONS'] . "</b></td>";           
echo "</tr></table>";
echo "<span style=\"font-size:11px; margin-top:5px; color:#666; font-weight:bold;\">FabricBack by Sunsilks</span><br>";
echo "<span style=\"font-size:11px; margin-top:5px; color:#666; font-weight:bold;\">1-800-745-5626</span>";       
echo "</div> <!-- End Left level div -->";


// code for right top 

echo "<div style=\"float:right\"> <!-- Right level div --><table class=\"box\" style=\"font-size:10px; width:150px;\" id=\"" . $curr_row . "\">";
echo "<tr nowrap><td>Cust: </td><td>Cust PO: </td><td>Cust Item: </td><td>Serial: </td><td>Yardage: </td><td>Rec Date: </td><td>Services: </td></tr><tr>";
echo "<td><b>" . $row['USERNAME'] . "</b></td>";
echo "<td><b>" . $row['CUST_PO_NUM'] . "</b></td>";
echo "<td><b>" . $row['CUST_ITEM_NUM']. "</b></td>";
echo "<td><b>" . $row['SERIAL_NUM'] . "</b></td>";
echo "<td><b>" . $row['YARDAGE'] . "</b></td>";
echo "<td><b>" . $row['REC_DATE_FORM'] . "</b></td>";
echo "<td><b>" . $row['SERVICE_OPTIONS'] . "</b></td>";
echo "</tr></table>";   


// code for right bottom
echo "
		<table class=\"boxPrint\" style=\"font-size:12px; width: 80%;\" id=\"timeTable\">
          <tr>
            <td>&nbsp;</td>
            <td><b>Start</b></td>
            <td><b>Stop</b></td>
            <td><b>Time</b></td>
            <td><b>Optr1</b></td>
            <td><b>Optr2</b></td>
          </tr>
          <tr>
            <td><b>Press 1</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Roll
                (back)</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Knit back</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td nowrap><b>N.Wov
          
          
          
                 back</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Stain 1</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Stain 2</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Press 2</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Press 3</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Trim/Cut</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Total time:</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>Date:</b></td>
            <td>&nbsp;</td>
          </tr>
    	</table> 
    </div> <!-- END Right level div -->
    
    
</div> <!-- END Top level div -->
";

$curr_row++;

if ($curr_row < $num_rows){ // div for the page break (only add page break if we're not at the last result row)
	echo "<div style=\"page-break-after:always; clear: both; height: 100px;\"></div>";
} else {
	echo "<div style=\"clear: both; height: 100px;\"></div>";
}
	
	

}




?>


<script>  
	
	

	// set the width of the top right element
	var setWidth = document.getElementById('timeTable').offsetWidth;
	for (i=0; i<<?=$curr_row?>; i++){
	document.getElementById(i).style.width = setWidth+'px';
	}
	
	// open the print dialogue, close the window
	window.print();
	setTimeout(function(){window.close();},1);
</script>
  
  </body>
</html>

<? mysql_close($conn); ?>