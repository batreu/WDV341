<?php
session_start();
//this is tricky because if you want to log into a different user account you can't just go back you have to log out
//get list of usernames and passwords from client add to database before testing

if (isset($_SESSION['validUser'])) {

    $validUser = true;

    $userName = $_SESSION['userName'];
} else {

    $userName = "";
    $passWord = "";

    $validUser = true;
    $msg = "";

    if (isset($_POST['submit'])) {


        $userName = $_POST['username'];
        $passWord = $_POST['password'];

        //connect to the database
        require 'connectPDO.php';

        //create sql command
        $sql = "SELECT count(*) FROM event_user_id WHERE event_user_name = :user AND event_user_password = :pass";
        //prepare statement
        $stmt = $conn->prepare($sql);
        //bind any variables
        $stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
        //execute
        $stmt->execute();

        $rowCount = $stmt->fetchColumn();


        if ($rowCount > 0) {

            $validUser = true;

            $_SESSION['validUser'] = true;
            $_SESSION['userName'] = $userName;
        } else {
            $validUser = false;
            $msg = "Invalid username or password! try again!";
        }

    } else {


        $validUser = false;
    }
}
    //variable
    $eventId = $_GET['eventId'];


try{
    //connect to database
    require_once 'connectPDO.php';
    //create SQL command
    $sql = "DELETE FROM wdv341_products WHERE product_id = :eventId;";
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
    <link href="portfolioSass.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">

    <title>DELETE Product PAGE</title>
    <style>
        body{
            background-color: limegreen;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#" style="font-family: 'Rubik Wet Paint', cursive; font-size: 55px;"><img src="images/devil.png" width="100px" height="100px">
            <span class="navbar-store-name">Chaos Games</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html"> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="boardGamesShop.php">Shop</a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="boardGamesShop.php">Board Games</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactForm.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="font-size: 14px;">Staff Login</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit" style="background-color:#081A2F; border-color: white; color: white;">Search</button>
            </form>
        </div>
    </div>
</nav>
<div id="castleTop"></div>
    <h1 style="background-color: grey; text-align: center;">DELETE PRODUCTS PAGE</h1>
<div class="formLogin" style="background-color: grey; margin-left: 33%">
    <?php
        if($count > 0){
            echo "<h3>$count row has been deleted for event_id $eventId</h3>";
        }
        else{
            echo "<h3>No rows deleted for selected event_id $eventId</h3>";
        }
    ?>
    <a class="button" href="login.php"> BACK TO ADMIN PAGE</a>
</div>

</body>
</html>