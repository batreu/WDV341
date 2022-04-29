<?php
//DELETE FROM DATABASE
    $eventId = $_GET['eventId'];


try{
    require_once 'connectPDO.php';

    $sql = "DELETE FROM wdv341_events WHERE event_id = :eventId;";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':eventId', $eventId);

    $stmt->execute();

    $count = $stmt->rowCount();


}
catch(PDOException $e)
{
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    error_log($e->getMessage());
    error_log(var_dump(debug_backtrace()));

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>WDV341 DELETE PAGE</title>
</head>
<body>
    <h1>WDV341 DELETE PAGE</h1>

    <input style="display:none" type="text" name="honeypot" value = 0>//THIS IS MY HONEYPOT
    <?php
        if($count > 0){
            echo "<h3>$count row has been deleted for event_id $eventId</h3>";
        }
        else{
            echo "<h3>No rows deleted for selected event_id $eventId</h3>";
        }
    if($_POST['honeypot'] != 0){
        $validForm = false;
        echo "unable to submit form";
    }
    ?>

</body>
</html>