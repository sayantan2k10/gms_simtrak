<?php
$to_email = "shahid576ali@gmail.com";
$subject = "Forget password";
$body = "Hello ,

Greetings from Simtrak! Your verification code is , valid for the next 5 minutes.
Please keep it confidential and do not share it with anyone.

Best regards,
Simtrak Team";
$headers = "From: aishwaryasingh44092@gmail.com";
mail($to_email, $subject, $body, $headers);


?>