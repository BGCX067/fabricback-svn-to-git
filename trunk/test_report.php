<?php
require_once('lib.php');

$course_id=$_GET['cid'];

$test_id=$_GET['tid'];


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
  

  <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="instructor_home.php" style="color:#FFF">Instructor Home Page </a> ---> <a href="course_mgmt.php" style="color:#FFF">Course Management </a> ---> <a href="course_exams.php?cid=<? echo $cid ?>" style="color:#FFF">Exam Management </a> ---> Test Report
  </div>
  <!-- /BreadCrumbs -->

  
  <?
  $result = mysql_query("   SELECT *,COUNT(TOPIC_ID), SUM(QUESTION_POINTS) FROM test NATURAL JOIN test_to_question NATURAL JOIN question NATURAL JOIN topic where TESTID='$test_id'  GROUP BY TOPIC_ID ");

echo "
    <h1>
      All Topics in Test 
    </h1>

<table class='box'>
<tr>
<th>Topic No.</th>
<th>Topic Name</th>
<th># Questions</th>
<th>Points from topic</th>

</tr>";

$totalpoints=0;
while($row = mysql_fetch_array($result))
  {

  echo "<tr>";
  echo "<td>" . $row['TOPIC_ID'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['COUNT(TOPIC_ID)'] . "</td>";
  echo "<td>" . $row['SUM(QUESTION_POINTS)'] . "</td>";
	$totalpoints=$totalpoints+$row['SUM(QUESTION_POINTS)'];
  echo "</tr>";
  }
  
echo "<table class='box'><tr><td>Total points for this Test: $totalpoints </tr></td></table></table>";


?>
  
  
  </body>
</html>

<? mysql_close($conn); ?>