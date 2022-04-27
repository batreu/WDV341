<?php
//init
$eventID = 11;

//re-use my same connect file
include 'connectPDO.php';

//SQL commands
$SQL = "SELECT event_id,event_name FROM wdv341_events WHERE event_id = :eventID";

$stmt = $conn->prepare($SQL);
$stmt->bindParam(':eventID',$eventID);
$stmt->execute();

//setting fetch mode to php assoc array
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$row=$stmt->fetch();

echo $row['event_id'];
echo $row['event_name'];

$eventObj = new stdClass();

$eventObj->eventName = $row['event_id'];
$eventObj->eventDescription = $row['event_name'];

$eventJson = json_encode($eventObj);

echo '<p style="background-color: blue; color: white; border: 5px black solid; ">';
echo $eventJson;
echo '</p>';

