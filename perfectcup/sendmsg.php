<?php

//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', '', 'perfectcup');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$name = mysqli_real_escape_string($mysqli, $_POST['name']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$message= mysqli_real_escape_string($mysqli, $_POST['message']);

$email2 = "abhi.singh232001@gmail.com";
$subject = "Test Message";

if (strlen($name) > 50) {
    echo 'name_long';

} elseif (strlen($name) < 2) {
    echo 'name_short';

} elseif (strlen($email) > 50) {
    echo 'email_long';

} elseif (strlen($email) < 5) {
    echo 'email_short';

} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'eformat';

} elseif (strlen($message) > 500) {
    echo 'message_long';

} elseif (strlen($message) < 5) {
    echo 'message_short';

} else {
	
	 //MAILER

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'abhi.singh232001@gmail.com';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

	$mail->AddReplyTo($email);
    $mail->From = $email2;
    $mail->FromName = $name;
    $mail->addAddress('abhi.singh232001@gmail.com', 'Admin');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'true';
    }


}
?>