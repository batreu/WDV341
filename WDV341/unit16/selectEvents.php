<?php

    //1. Connect to the database - 
    //2. Create your SQL command - 
    //3. Prepare your statement - 
    //4. Bind any variables (if any) - 
    //5. Execute your statement - 
    //process the results

    include 'connectPDO.php';       //brings in an external file

    $sql = "SELECT event_id,event_name,event_description FROM wdv341_events";      //create your SQL command

    $stmt = $conn->prepare($sql);       //prepare the prepared statement 'object'

    $stmt->execute();           //run the sql command and create a result object (mini database)

    $stmt->setFetchMode(PDO::FETCH_ASSOC);      //return any data as as PHP associative array



?>

<style>

    span {
        margin-right:10px;
    }

    p   {
        border:thin solid black;
        width:500px;
    }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>Copy of my Select page for unit 16</title>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>

    <h2>UNIT 16 SelectPage</h2>
    
    <h3>Current Events!</h3>

    <p style="background-color: grey; margin-left: 33%; width: 550px;">
        Event Name      .       Event Description
    </p>
<div class="container" style="background-color: grey; margin-left: 33%; width: 550px; border: 3px black solid;">
    <?php
        while( $row=$stmt->fetch()){
            echo "<p>";
                echo "<span>";
                    echo $row['event_name'];            // [0]
                echo "</span>";
                echo "<span>";
                    echo $row['event_description'];     // [1]
                echo "</span>";

                echo "<span>";
                    echo $row['event_id'];     // [1]
                echo "</span>"; 

                echo "<a href='deleteEvent.php?eventId=" . $row['event_id'] . "'><button class='button' style='width: auto; height: 20px; font-size: 11px;'>";
                    echo "Delete This Event";
                echo "</button></a>";

                //add update button for each event displayed on this page
                echo "<a href='updateEvent.php?eventId=" . $row['event_id'] . "'><button class='button' style='width: auto; height: 20px; font-size: 11px;'>";
                    echo "Update This Event";
                echo "</button></a>";                

            echo "</p>\n";
        }
    ?>
</div>
</body>
</html>