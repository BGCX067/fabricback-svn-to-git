<?php
require_once('lib.php');
?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <link rel="stylesheet" href="signup.css" type="text/css"/>
  </head>
  <body>
  
  <!-- BreadCrumbs -->
  <div style="font-size:12px; color:#FFF">
  Your Location:
  <a href="instructor_home.php" style="color:#FFF">Instructor Home Page </a> ---> <a href="topic_mgmt.php" style="color:#FFF"> Question Library Management </a> ---> View all questions in all topics
  </div>
  <!-- /BreadCrumbs -->

  
  <?
  $result = mysql_query("SELECT * FROM topic NATURAL JOIN question NATURAL JOIN instr_user");

echo "
    <h1>
      All questions in all topics
    </h1><br>
<input type=\"button\" onClick=\"window.print()\" value=\"Print This Page\"/>

<table class='box' style='background-color:#FFF'>
<tr>
<th>Question ID</th>
<th>Question</th>
<th>Answer</th>
<th>Instructor</th>
</tr>";



while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['QUESTION_ID'] . "</td>";
  echo "<td>" . $row['QUESTION_TEXT'] . "</td>";
  echo "<td>" . $row['QUESTION_ANS'] . "</td>";
  echo "<td nowrap>" . $row['FIRST_NAME'] . " " . $row['LAST_NAME'] . "</td>";  
  echo "</tr>";
  }
echo "</table>";

?>  
  </body>
</html>

<? mysql_close($conn); ?>