<?php
require_once('Mail.php');
require_once('Mail/mime.php');

// email address of the recipient
$to = "jrbapna@gmail.com";

// email address of the sender
$from = "jrbapna@gmail.com";

// subject of the email
$subject = "Hello world from coolersport";

// email header format complies the PEAR's Mail class
// this header includes sender's email and subject
$headers = array('From' => $from,
'Subject' => $subject);

// We will send this email as HTML format
// which is well presented and nicer than plain text
// using the heredoc syntax
// REMEMBER: there should not be any space after PDFMAIL keyword
$htmlMessage = "ho";

// create a new instance of the Mail_Mime class
$mime = new Mail_Mime();

// set HTML content
$mime->setHtmlBody($htmlMessage);

// IMPORTANT: add pdf content as attachment

// build email message and save it in $body
$body = $mime->get();

// build header
$hdrs = $mime->headers($headers);

// create Mail instance that will be used to send email later
$mail = &Mail::factory('mail');

// Sending the email, according to the address in $to,
// the email headers in $hdrs,
// and the message body in $body.
$mail->send($to, $hdrs, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
} else {
  echo("<p>Message successfully sent!</p>");
}
?>