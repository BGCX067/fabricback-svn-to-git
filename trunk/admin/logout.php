<?


// set the expiration date to one hour ago
setcookie ("user", "", time() - 36000);

header( 'Location: ../index.php' ) ;


?>