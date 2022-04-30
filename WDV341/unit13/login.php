<?php
session_start();
//this is tricky because if you want to log into a different user account you cant just go back you have to log out

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
    <link href="css/mainSiteCss.css" rel="stylesheet" type="text/css">
    <title>Unit 13 Create a login.php page</title>
</head>
<body style="background-color: black;">

<?php 
if(!$validUser){
    ?>

        <p style="color:red"><?php echo $msg;?></p>
        <form method="post" action="#" style="width: 550px; border: white 5px solid; border-radius: 5%; background-color: grey; color: black; margin-left: 33%">
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
        <div style="width: 550px; border-radius: 5%; border: white 5px solid; background-color: grey; margin-left: 33%;">
        <h3>Welcome Back: <?php echo $userName; ?></h3>
        <h3>Administrator Actions</h3>

            <a href="eventsForm.php" class="button">ADD NEW EVENT</a>
            <br>
            <a href="selectEvents.php" class="button">UPDATE/DELETE EVENTS</a>
            <br>



        <p><a href="logout.php" class="button">Logout of Admin Panel</a></p>
        </div>
    <?php   
}
    ?>

</body>

</html>