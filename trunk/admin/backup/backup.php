<?
// Inspired by tutorials: http://www.phpfreaks.com/tutorials/130/6.php
// http://www.vbulletin.com/forum/archive/index.php/t-113143.html
// http://hudzilla.org


// Create the mysql backup file
// edit this section
$dbhost = "192.168.1.104"; // usually localhost
$dbuser = "fabricba_jason";
$dbpass = "jason4221199";
$dbname = "fabricba_ordermgmt";
$sendto = "Sunsilks <sunsilks2@gmail.com>";
$sendfrom = "FabricBack Daily Backup <noreply@fabricback.com>";
$sendsubject = "FabricBack Daily Backup: " . date("m-d-Y");
$bodyofemail = "Attached is the daily backup.";
// don't need to edit below this section

$backupfile = $dbname . date("m-d-Y") . '.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");


// Mail the file


include('Mail.php');
include('Mail/mime.php');


$message = new Mail_mime();
$text = "$bodyofemail";
$message->setTXTBody($text);
$message->AddAttachment($backupfile);
$body = $message->get();
$extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
$headers = $message->headers($extraheaders);
$mail = Mail::factory("mail");
$mail->send("$sendto", $headers, $body);


// Delete the file from your server
unlink($backupfile);
?>