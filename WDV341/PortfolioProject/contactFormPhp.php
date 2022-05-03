<?php

foreach($_POST as $key => $value)
{

}
// variables
$array = array_values($_POST);
$name = $array[0];
$email_to = $array[1];
$reason = $array[2];
$message = $array[3];

$date = date("m/d/Y");

$email_response = "Thank you for reaching out to us on " .$date.$array[0]." (".$array[1].")".". We will respond to your ".$array[2]." as soon as possible."."<br>"." ";

$your_message = "Your ".$array[2].":<br>".$array[3]."<br>";

$confirmation_message = "Your ".$array[2]." has been successfully submitted."."<br>"." A confirmation email has been sent to ".$array[1]; //this is an output confirmation msg that loads once .php file finishes

$message = $email_response.$your_message.$confirmation_message;
$response_message = "This is a response email body for the customer";


//functions
function sendMail($name,$email_to,$reason,$message) // sends the form to designated email address
{
    mail("contact@brandontreu.name", $reason, $message,"From: ".$email_to );
}

function confirmation($email_to)//sends confirmation email to sender email
{
    mail($email_to,"Confirmation Email", "This is an email response","From: contact@brandontreu.name");
    echo"Email confirmation sent to  ".$email_to;
}

sendMail($name,$email_to,$reason,$message);
confirmation($email_to);

//output response
//echo "<p>"; echo "Your Message has been sent, look for a response soon!"; echo "</p>";
    header("Location: contactConfirmation.html");
?>