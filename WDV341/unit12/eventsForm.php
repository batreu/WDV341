<?php

//form validation
$validForm = "";

$eventID = "";
$name = "";
$desc = "";
$pres = "";
$date = "";
$time = "";

$idErrorMsg = "";
$nameErrorMsg = "";
$descErrorMsg = "";
$presErrorMsg = "";
$dateErrorMsg = "";
$timeErrorMsg = "";

if(isset($_POST['submit']))
{
    $validForm = true;

    $eventID = $_POST['event_id'];
    $name = $_POST['event_name'];
    $desc = $_POST['event_description'];
    $pres = $_POST['event_presenter'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $date_insert = date("Y/m/d");
    $date_update = $date_insert;

    if($_POST['honeypot'] != 0){
        $validForm = false;
        echo "unable to submit form";
    }
    if($eventID == "")
    {
        $idErrorMsg = "id required";
        $validForm = false;
    }
    if($name == "")
    {
        $nameErrorMsg = "name required";
        $validForm = false;
    }
    if($desc == "")
    {
        $descErrorMsg = "description required";
        $validForm = false;
    }
    if($pres == "")
    {
        $presErrorMsg = "presenter required";
        $validForm = false;
    }
    if($date == "")
    {
        $dateErrorMsg = "date required";
        $validForm = false;
    }
    if($time == "")
    {
        $timeErrorMsg = "time required";
        $validForm = false;
    }
    if($validForm)
    {

        //connect to the database
        require 'connectPDO.php';
        //prepare statement
        $sql = "INSERT INTO wdv341_events (event_id,event_name,event_description,event_presenter,event_date,event_time,event_date_inserted,event_date_updated) VALUES (:eventID, :name, :desc, :pres, :date, :time, :inDate, :upDate)";

        $stmt = $conn->prepare($sql);

        //bind parameters
        $stmt->bindParam(':eventID', $eventID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc',$desc);
        $stmt->bindParam(':pres',$pres);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':time',$time);
        $stmt->bindParam(':inDate',$date_insert);
        $stmt->bindParam(':upDate',$date_update);

        //execute
        $result = $stmt->execute();
    }
}






?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>Events Form Unit 12</title>
</head>
<style>
    .body{
        background-color: #aaaaaa;
    }

</style>
<body style="background-color: background-color: #aaaaaa;">

<?php
if($validForm)
{
    echo "Events Updated!";
}
else{
    ?>
    <form action="eventsForm.php" method="post" style="margin-left: 33%; border: 4px white solid; border-radius: 5%; width: 350px; text-align: center; background-color: grey">

        <label for="event_id" style="color: white">events_id</label>
        <input type="text" name="event_id" id="event_id" placeholder="id" value = "<?php echo $eventID;?>">
        <span><?php echo $idErrorMsg;?></span><br>

        <label for="event_name" style="color: white">events_name</label>
        <input type="text" name="event_name" id="event_name" placeholder="Name" value = "<?php echo $name;?>">
        <span><?php echo $nameErrorMsg;?></span><br>

        <label for="event_description" style="color: white">event_description</label>
        <input type="text" name="event_description" id="event_description" value = "<?php echo $desc;?>">
        <span><?php echo $descErrorMsg;?></span><br>

        <label for="event_presenter" style="color: white">event_presenter</label>
        <input type="text" name="event_presenter" id="event_presenter" value = "<?php echo $pres;?>">
        <span><?php echo $presErrorMsg;?></span><br>

        <label for="event_date" style="color: white">event_date</label>
        <input type="date" name="event_date" id="event_date" value = "<?php echo $date;?>">
        <span><?php echo $dateErrorMsg;?></span><br>

        <label for="event_time" style="color: white">event_time</label>
        <input type="time" name="event_time" id="event_time" value = "<?php echo $time;?>">
        <span><?php echo $timeErrorMsg;?></span><br>

        <input style="display:none" type="text" name="honeypot" value = 0>

        <input type="submit" class="button" name="submit" id="submit"><br>
    </form>
    <?php
}
?>
</body>

</html>
