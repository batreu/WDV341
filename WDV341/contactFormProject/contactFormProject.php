<?php

foreach($_POST as $key => $value)
{

}

$array = array_values($_POST);

$email_response = "Thank you for reaching out to us ".$array[0]." (".$array[1].")".". We will resond to your ".$array[2]." as soon as possibe.<br> ";
$your_message = "Your ".$array[2].":<br>".$array[3]."<br>";
$confirmation_message = "Your ".$array[2]." has been successfully submitted. A confirmation email has been sent to ".$array[1];

$message = $email_response.$your_message.$confirmation_message;
$response_message = "This is a response email body for the customer";

mail($array[1], "Email Confirmation", $response_message,"From: brandon.a.treu@gmail.com.com");
mail("From: brandon.a.treu@gmail.com.com", $array[2], $message,"From: ".$array[1] );

?>