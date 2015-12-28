<?php


$dbhost = '192.168.1.104';
$dbuser = 'fabricba_jason';
$dbpass = 'jason4221199';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'fabricba_ordermgmt';
mysql_select_db($dbname);

if(!$_COOKIE['user'] && $_SERVER['PHP_SELF']!='/admin/admin_login.php'){
	header( 'Location: admin_login.php' ) ;
}

setcookie("user", $_COOKIE['user'], time()+3600); // each time lib.php is called, reset the cookie! 


if(   strcasecmp( $_COOKIE['user'],'jason' )==0   ){
	$view_ids = true; // this will display the ID's, such as ROLL_ID, USER_ID, ORDER_ID etc
	$edit_user = true; // modify or delete administrator accounts
	$test_mode = true;
	$display_neutral = true;
	//$display_back = true;

}

if(  strcasecmp( $_COOKIE['user'],'admin' )==0 || strcasecmp( $_COOKIE['user'],'lana' )==0  ||  strcasecmp( $_COOKIE['user'],'lakshmi' )==0     ){
	$view_ids = false; // this will display the ID's, such as ROLL_ID, USER_ID, ORDER_ID etc
	$edit_user = false; // modify or delete administrator accounts
	$test_mode = false;
	$display_neutral = true;
	//$display_back = false;

}

if(   strcasecmp( $_COOKIE['user'],'admin2' )==0   ){
	$view_ids = false; // this will display the ID's, such as ROLL_ID, USER_ID, ORDER_ID etc
	$edit_user = false; // modify or delete administrator accounts
	$test_mode = false;
	$display_neutral = false;
	//$display_back = true;
	
}



?>