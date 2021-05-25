<?php
$to_email = "izzatjohari@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: izzatjohari94@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "yes";
} else {
    echo "boo";
}