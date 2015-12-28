<?php

$dbhost = '192.168.1.104';
$dbuser = 'fabricba_jason';
$dbpass = 'jason4221199';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'fabricba_ordermgmt';
mysql_select_db($dbname);

if(!$_COOKIE['user'] && $_SERVER['PHP_SELF']!='/cust_login.php'){
	header( 'Location: cust_login.php' );
}

if($_COOKIE['user']){
$curr_user_id=mysql_result(mysql_query("SELECT cust_user.CUST_ID FROM cust_user WHERE cust_user.USERNAME='$_COOKIE[user]'"),0,"CUST_ID");
}

if($_COOKIE['user']=='jason'){
	$view_ids = true; // this will display the ID's, such as ROLL_ID, USER_ID, ORDER_ID etc
	$edit_user = true; // modify or delete administrator accounts
}

?>