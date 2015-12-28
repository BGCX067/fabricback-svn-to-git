<?php
require_once('lib.php');

$topic_id=$_GET['tid'];
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
  <a href="instructor_home.php" style="color:#FFF">Instructor Home Page </a> ---> <a href="topic_mgmt.php" style="color:#FFF"> Question Library Management </a> ---> <a href="view_topic.php?id=<? echo $topic_id ?> "style="color:#FFF"> View Questions in Topic </a> ---> Search for a question in this topic  </div>
  <!-- /BreadCrumbs -->

  
  
  
  <form action="search_topic_question_results.php?tid=<? echo $topic_id ?>" method="POST" name="search_form">
    <? include('error.php'); ?>
    <h1>
      Search for a question
    </h1>
    <table class="box">
      <tr>
        <td>* Question Type</td>
        <td>
        <select name="q_type">
        <option value="TF">TF</option>
        <option value="MCQ">MCQ</option>
        <option value="Both">Both</option>        
        </select>
        </td>
      </tr>
      <tr>
        <td>* Keyword</td>
        <td><input type="text" name="keyword"/></td>
      </tr>
      <tr>
        <td>* Question ID</td>
        <td><input type="text" name="qid" /></td>
      </tr>

      <tr>
        <td colspan="2" class="submitCell">
          <input type="Submit" value="Submit" class="btn" />
        </td>
      </tr>
    </table>
  </form>

  
  </body>
</html>

