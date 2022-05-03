<?php
session_start();
//this is tricky because if you want to log into a different user account you can't just go back you have to log out
//get list of usernames and passwords from client add to database before testing

if( isset($_SESSION['validUser'])){

    $validUser = true;

    $userName = $_SESSION['userName'];
}
else{

    $userName = "";
    $passWord = "";
    
    $validUser = true;
    $msg = "";

    if( isset($_POST['submit'])){


    
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
    

    

    
        if($rowCount > 0){

            $validUser = true;

            $_SESSION['validUser'] = true; 
            $_SESSION['userName'] = $userName;
        }
        else{
            $validUser = false;
            $msg = "Invalid username or password! try again!";
        }
    
    }
    else{


        $validUser = false;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--My custom css file-->
    <link href="portfolioSass.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <!--ICON AND GRAPHIC <a href="https://www.flaticon.com/free-icons/devil" title="devil icons">Devil icons created by juicy_fish - Flaticon</a>//https://ericaofanderson.tumblr.com/post/170155287606/crystal-cave-you-can-get-this-gif-as-a-looping-->
    <title>Portfolio login page</title>
</head>
<body style="background-color: limegreen;">
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
<?php 
if(!$validUser){
    ?>

        <p style="color:red"><?php echo $msg;?></p>
        <form method="post" action="#" class="formLogin" style="width: 550px; background-color: grey; color: black; margin-left: 33%;">
            <h3>Login to access your Admin Functions</h3>
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="text" name="password" id="password">
            </p>
            <p>
                <input type="submit" value="Sign On" name="submit" id="submit" class="button">
                <input type="reset" class="button">
            </p>
        </form>
    <?php
}
else{
    ?>
    <div style="width: 550px;  background-color: grey; margin-left: 33%;" class="formLogin">
        <h3>Welcome Back: <?php echo $userName; ?></h3>
        <h3>Administrator Actions</h3>

        <a href="eventsForm.php" class="button">ADD A NEW BOARDGAME</a>
        <br>
        <br>
        <br>
        <a href="selectEvents.php" class="button">UPDATE/DELETE BOARDGAMES</a>
        <br>
        <br>
        <br>
        <p><a href="logout.php" class="button">Logout of Admin Panel</a></p>
    </div>
    <?php
}
?>

</body>

</html>