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
    //1. Connect to the database - 
    //2. Create your SQL command - 
    //3. Prepare your statement - 
    //4. Bind any variables (if any) - 
    //5. Execute your statement - 
    //process the results

    include 'connectPDO.php';       //brings in an external file

    $sql = "SELECT product_id,product_name,product_description,product_price,product_image,product_inStock FROM wdv341_products";      //create your SQL command

    $stmt = $conn->prepare($sql);       //prepare the prepared statement 'object'

    $stmt->execute();           //run the sql command and create a result object (mini database)

    $stmt->setFetchMode(PDO::FETCH_ASSOC);      //return any data as as PHP associative array



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

    <title>Copy of my Select page for portfolio project</title>

    <style>

        body{
            background-color: limegreen;
        }
        span {
            margin-right:10px;
        }

        p   {
            border:thin solid black;
            width:500px;
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
    <h1 style="background-color: grey; text-align: center; height: 75px;">Board Games Update Information Page
    <br>
    </h1>
<div id="castleTop" style="margin-top: -1%"></div>
<div class="formLogin" style="margin-left: 33%; width: 550px; height: auto; background-color: #aaaaaa; margin-top: 1%; text-align: center; align-content: center; justify-content: center;">
    <?php
        while( $row=$stmt->fetch()){
            echo "<p>";
                echo "<span>";
                    echo $row['product_name'];
                echo "</span>";
                echo "<span>";
                    echo $row['product_description'];
                echo "</span>";

                echo "<span>";
                    echo $row['product_id'];
                echo "</span>";

                echo "<span style='border: 1px black solid;'> STOCK: ";
                    echo $row['product_inStock'];
                echo "</span>";

            echo "<a href='deleteEvent.php?eventId=" . $row['product_id'] . "'><br><button class='button' style='width: auto; height: 20px; font-size: 11px;'>";
                    echo "Delete This Product";
                echo "</button></a>";

                //add update button for each event displayed on this page
                echo "<a href='updateEvent.php?eventId=" . $row['product_id'] . "'><br><button class='button' style='width: auto; height: 20px; font-size: 11px;'>";
                    echo "Update This Product";
                echo "</button></a>";                

            echo "</p>\n";
        }
    ?>
    <a class="button" href="login.php"> BACK TO ADMIN PAGE</a>
</div>

<br>
<br>
</body>
</html>