<?php
session_start();        //access the current session or start a new session

if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    $validUser = true;      //make you a validUser for THIS page
    //get username
    $userName = $_SESSION['userName'];
}
else{
    //deny access, return to login page/home page
    header("Location: login.php");              //PHP redirect back to another page
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>The logged in homepage</title>
</head>
<body>
<h1>Logged in Homepage</h1>
<h3 style="width: 550px; color: limegreen; background-color: black; border: limegreen 5px solid; border-radius: 5%; margin-left: 33%;">
    YOU CAN NOW SEE THE SECRET SAUCE
    </h3>
<a href="logout.php" class="button"> Log Out</a>
<p>If you log out you won't be able to view this page!</p>