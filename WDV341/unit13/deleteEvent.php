<?php

    //variable
    $eventId = $_GET['eventId'];


try{
    //connect to database
    require_once 'connectPDO.php';
    //create SQL command
    $sql = "DELETE FROM wdv341_events WHERE event_id = :eventId;";
    //prepare statement
    $stmt = $conn->prepare($sql);
    //bind variables
    $stmt->bindParam(':eventId', $eventId);
    //execute
    $stmt->execute();

    $count = $stmt->rowCount();



}
catch(PDOException $e)
{
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
    error_log(var_dump(debug_backtrace()));
    //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>DELETE EVENT PAGE Assignment 16</title>
</head>
<body>
    <h1>WDV341 Delete Event Page</h1>
<div class="container">
    <?php
        if($count > 0){
            echo "<h3>$count row has been deleted for event_id $eventId</h3>";
        }
        else{
            echo "<h3>No rows deleted for selected event_id $eventId</h3>";
        }
    ?>
</div>
</body>
</html>