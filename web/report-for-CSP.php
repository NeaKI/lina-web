<?php
@session_start();

$data = json_decode($HTTP_RAW_POST_DATA,true);
$to = 'sven@neawolf.de';
$subject = 'CSP Violations : Lina-Narzisse.de';

$json = file_get_contents('php://input');
$data = json_decode($json);

$message1 = print_r($data, true);
$message2 = print_r($_SESSION, true);
$message3 = print_r($_SERVER, true);

$message = nl2br($message1 . $message2 . $message3);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $subject . "\r\n";

mail($to, $subject, $message, $headers);
