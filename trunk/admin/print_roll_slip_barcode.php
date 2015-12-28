<?php
require_once('lib.php');

$cid=$_GET['cid'];
$oid=$_GET['oid'];
$rid=$_GET['rid'];


$query=" SELECT *, DATE_FORMAT(REC_DATE, '%m/%d/%Y') AS REC_DATE_FORM FROM order_roll NATURAL JOIN cust_order NATURAL JOIN cust_user WHERE roll_ID='$rid' ";
$result=mysql_query($query);


$cust_username=mysql_result($result,$i,"USERNAME");
$cust_po_num=mysql_result($result,$i,"CUST_PO_NUM");
$cust_item_num=mysql_result($result,$i,"CUST_ITEM_NUM");
$serial_num=mysql_result($result,$i,"SERIAL_NUM");
$yardage=mysql_result($result,$i,"YARDAGE");
$receive_date=mysql_result($result,$i,"REC_DATE_FORM");
$service_options=mysql_result($result,$i,"SERVICE_OPTIONS");

$roll_id_bar = 100000000000 + $rid;


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
    <script language="JavaScript" src="../gen_validatorv31.js" type="text/javascript"></script>    
    <script language="JavaScript" src="datetimepicker.js"></script>  
	<script type="text/javascript" src="barcode/barcode.js"></script>
	<link rel="stylesheet" href="barcode/barcode_style.css" type="text/css"/>   
</head>
  
<body>
<div style="margin-top:-20px;"> <!-- Top level div -->
    
  <div style="float:left"> <!-- Left level div -->
        <table class="box" style="font-size:12px; width:150px;">
        
          <tr>
             <td><b><? echo $cust_username ?></b></td>
          </tr> 
          
          <tr>
            <td>Cust PO No: </td>  
          </tr>
          <tr>
            <td><b><? echo $cust_po_num ?></b></td>        
          </tr>
    
          <tr>
            <td>Cust Item: </td>  
          </tr>
          <tr>
            <td><b><? echo $cust_item_num ?></b></td>        
          </tr>     
          
          <tr>
            <td>Serial: </td>  
          </tr>
          <tr>
            <td><b><? echo $serial_num ?></b></td>        
          </tr>          
          
          <tr>
            <td>Yardage: </td>
          </tr>
          <tr>
            <td><b><? echo $yardage; ?></b></td>  
          </tr>
          
          <tr>
            <td>Rec Date: </td>
          </tr>
          <tr>
            <td><b><? echo $receive_date; ?></b></td>  
          </tr>      
          
          <tr>  
            <td>Services: </td>
            </tr>
            <tr>
            <td><b><? echo $service_options; ?></b></td>              
          </tr>
          
        </table>  

     
          
    <div><span style="font-size:11px; margin-top:5px; color:#666; font-weight:bold;">FabricBack by Sunsilks</span><br>
         <span style="font-size:11px; margin-top:5px; color:#666; font-weight:bold;">1-800-745-5626</span> </div>
     
     
     
     
     
     
         
                
	</div> <!-- End Left level div -->
    
    
    
    
    
    
    <div style="float:right"> <!-- Right level div -->

        <table class="box" style="font-size:10px; width:150px;" id="aboveTimeTable">
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
            <td><b><? echo $serial_num ?></b></td>  
            <td><b><? echo $yardage; ?></b></td>  
            <td><b><? echo $receive_date; ?></b></td>  
            <td><b><? echo $service_options; ?></b></td> 
          </tr>
        </table>    



		<table class="boxPrint" style="font-size:12px; width: 80%;" id="timeTable">
          <tr>
            <td>&nbsp;</td>
            <td><b>Check</b></td>
            <td colspan="4" rowspan="13" width="300px">
            
            <div style="margin-left:30px;">
            <!-- IMPORT BARCODE -->
            <?  include 'barcode/barcode.php' ?>
            <!-- END IMPORT BARCODE -->    
            </div>
            
            </td>
          </tr>
          <tr>
            <td><b>Press 1</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Roll
                (back)</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Knit back</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td nowrap><b>N.Wov back</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Stain 1</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Stain 2</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Press 2</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Press 3</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Trim/Cut</b></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><b>Total time:</b></td>
            <td>&nbsp;</td>
          </tr>
    	</table> 
    </div> <!-- END Right level div -->
    
    
</div> <!-- END Top level div -->


<script>  

	// set the width of the top right element
	var setWidth = document.getElementById('timeTable').offsetWidth;
	document.getElementById('aboveTimeTable').style.width = setWidth+'px';
	
	setTimeout("onloadPrint()", 100)

	
	
	function onloadPrint(){
	// open the print dialogue, close the window
	window.print();
	setTimeout(function(){window.close();},1);
	}
</script>
  
  </body>
</html>

<? mysql_close($conn); ?>