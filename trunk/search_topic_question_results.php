<?php
require_once('lib.php');


$topic_id=$_GET['tid'];

$q_type=$_POST['q_type'];

$keyword=$_POST['keyword'];

$qid=$_POST['qid'];


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
  <a href="instructor_home.php" style="color:#FFF">Instructor Home Page </a> ---> <a href="topic_mgmt.php" style="color:#FFF"> Question Library Management </a> ---> <a href="view_topic.php?id=<? echo $topic_id ?> "style="color:#FFF"> View Questions in Topic </a> ---> Search Results  </div>
  <!-- /BreadCrumbs -->

  <? // echo "qtype: " . $q_type ; ?>
  <? // echo "keyword: " . $keyword ; ?>
  <? // echo "qid: " . $qid ; ?>

  <?
  
if($q_type=='TF' && $keyword=='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='TF' " );
} elseif ($q_type=='TF' && $keyword!='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='TF' && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
} elseif ($q_type=='TF' && $keyword=='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='TF' && QUESTION_ID='$qid' ");
} elseif ($q_type=='TF' && $keyword!='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='TF' && QUESTION_ID='$qid' && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
}

if($q_type=='MCQ' && $keyword=='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='MCQ' " );
} elseif ($q_type=='MCQ' && $keyword!='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='MCQ' && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
} elseif ($q_type=='MCQ' && $keyword=='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='MCQ' && QUESTION_ID='$qid' ");
} elseif ($q_type=='MCQ' && $keyword!='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_TYPE='MCQ' && QUESTION_ID='$qid' && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
}

if($q_type=='Both' && $keyword=='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id  " );
} elseif ($q_type=='Both' && $keyword!='' && $qid==''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
} elseif ($q_type=='Both' && $keyword=='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_ID='$qid' ");
} elseif ($q_type=='Both' && $keyword!='' && $qid!=''){
  $result = mysql_query("SELECT * FROM question NATURAL JOIN topic NATURAL JOIN instr_user WHERE TOPIC_ID=$topic_id && QUESTION_ID='$qid' && (QUESTION_ANS LIKE '%$keyword%' || QUESTION_TEXT LIKE '%$keyword%' || FIRST_NAME LIKE '%$keyword%') ");
}


echo "
    <h1>
      Search Results
    </h1><br>

<table class='box'>
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
  echo "<td>" . $row['FIRST_NAME'] . " " . $row['LAST_NAME'] . "</td>";  
  echo "</tr>";
  }
echo "</table>";

?>  
  </body>
</html>

<? mysql_close($conn); ?>