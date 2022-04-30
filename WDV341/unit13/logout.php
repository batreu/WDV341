<?php
session_start();
// this is just to get us logged out of current account

if( isset($_SESSION['validUser'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
    //direct back to another page
}
else{
    header("Location: login.php");
    //direct back to another page
}
?>