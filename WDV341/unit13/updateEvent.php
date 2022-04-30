<?php

//variables
    $eventName = "";        
    $eventDesc = "";
    $eventPresenter = "";

    $eventNameErrorMsg = "";
    $eventDescErrorMsg = "";
    $eventPresenterErrorMsg = "";

    $validForm = "";


if( isset($_POST['submit'])){
    //form has been SUBMITTED by the user
    //echo "<h1>Form has been submitted</h1>";

    $eventName = $_POST['event_name'];
    $eventDesc = $_POST['event_description'];
    $eventPresenter = $_POST['event_presenter'];
    $eventId = $_GET['eventId'];

    //NEED TO GET eventId at this point for the UPDATE


    //Validate input values

    $validForm = true;      //always assume the form is Good at the beginning

    //VALIDATION 
    if($eventName == ""){
        //display error for event name
        $eventNameErrorMsg = "Event Name is required";
        $validForm = false;
    }

    if($eventDesc == ""){
        $eventDescErrorMsg = "Event Description is required";
        $validForm = false;
    }

    if($eventPresenter == ""){
        $eventPresenterErrorMsg = "Event Presenter is required";
        $validForm = false;
    }

    //if the form is good then continue server side processing
    //else display form to the users with any error messages as needed
    if( $validForm ){
        //echo "<p>Form is valid. So insert into the database</p>";

        //INSERT data into the database!
        //Working with a database main steps!
        //connect to the database
        try{
            require 'connectPDO.php';

            //How to check for duplicate entries
            //MUST KNOW THE RULES of the application/data
            //take the input value(s) to read the database looking for those values
            //SELECT event_description from wdv341_events table where event_description = :eventDesc;
            //if you find one or more rows in the result you have a duplicate

            $today = date("Y-m-d"); //today's date as YYYY-MM-DD

            //build the sql statement   use the UPDATE statement

            $sql =  "UPDATE wdv341_events ";
            $sql .= "SET event_name = :name, event_description = :desc, event_presenter = :presenter ";
            $sql .= "WHERE event_id = :eventID";

                //$sql = "INSERT INTO wdv341_events ";
                //$sql .= "(event_name, event_description, event_presenter, event_date_inserted) ";
                //$sql .= "VALUES (:name, :desc, :presenter, :date_insert);";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //testing jhg**
            //echo "<h1>event name: $eventName</h1>";
            //echo "<h1>event desc: $eventDesc</h1>";
            //echo "<h1>event Presenter: $eventPresenter</h1>";
            //echo "<h1>event ID: $eventId</h1>";


            //bind the parameters
            $stmt->bindParam(':name',$eventName);
            $stmt->bindParam(':desc',$eventDesc);
            $stmt->bindParam(':presenter',$eventPresenter);
            $stmt->bindParam(':eventID', $eventId);

            //execute the statement
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
            error_log($e->getMessage());
            error_log(var_dump(debug_backtrace()));

        }


    }
    else{
        //something snarky
    }
}
else{
    //FOR INPUT FORM the user needs to see the empty form so they can enter data
    //echo "<h1>Form is new and needs to be input</h1>";

    //FOR UPDATE FORM the user needs to the original data for that record from the database
    /*
        get the id to update
        connect to the database
        create the SQL command  -  SELECT the data from the database
        prepare the statement
        bind the parameter - eventId 
        execute the statement
        pull the data from the result
        display the data on the form fields

    */

    $eventId = $_GET['eventId'];        

    //echo "<h1>Event id to update: $eventId</h1>";
    try{
        require_once 'connectPDO.php';

        $sql = "SELECT event_name, event_description, event_presenter FROM wdv341_events WHERE event_id = :eventID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':eventID', $eventId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $row=$stmt->fetch();

        //load the incoming data into variables
        //these variables will echo their values into the fields on the form
        $eventName = $row['event_name'];
        $eventDesc = $row['event_description'];
        $eventPresenter = $row['event_presenter'];
    }//end try block
    catch(PDOException $e)
    {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
        error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log(var_dump(debug_backtrace()));
        //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
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
    <title>Events Update Form</title>

    <style>
        .errorMsg {
            color:red;
            font-style: italic;
        }

    </style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>

    <h2>Update Event Form</h2>

    <?php
        if($validForm){
            echo "<h3>Thank you! Your event has been updated.</h3>";
        }
        else{
    ?>
    <form method="post" action="updateEvent.php?eventId=<?= $eventId; ?>">
        <p>
            <label for="event_name">Event Name: </label>
            <input type="text" name="event_name" id="event_name" placeholder="Name" value="<?php echo $eventName; ?>">
            <span class="errorMsg"><?php echo $eventNameErrorMsg; ?></span>
        </p>
        <p>
            <label for="event_description">Event Description: </label>
            <input type="text" name="event_description" id="event_description" value="<?php echo $eventDesc; ?>">
            <span class="errorMsg"><?php echo $eventDescErrorMsg; ?></span>
        </p>
        <p>
            <label for="event_presenter">Event Presenter: </label>
            <input type="text" name="event_presenter" id="event_presenter" value="<?php echo $eventPresenter; ?>">
            <span class="errorMsg"><?php echo $eventPresenterErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="Submit" name="submit" class="button">
            <input type="reset" value="Try Again" class="button">
        </p>
    </form>
    <?php
            }//end if statement to show form or not show form on confirmation
    ?>
    
</body>
</html>
