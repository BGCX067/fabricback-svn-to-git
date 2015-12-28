<?php
include 'lib.php';

$tableName  = 'admin_user';
$backupFile = 'backup/admin_user.sql';
$query      = "  SELECT * INTO OUTFILE '$backupFile' FROM $tableName  ";
$result = mysql_query($query);

include 'closedb.php';
?>

worked?