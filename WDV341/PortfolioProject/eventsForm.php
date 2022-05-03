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
//form validation
$validForm = "";

//$eventID = "";
$name = "";
$desc = "";
$price = "";
$image = "";
$status = "";
$inStock = "";

//$idErrorMsg = "";
$nameErrorMsg = "";
$descErrorMsg = "";
$priceErrorMsg = "";
$imageErrorMsg = "";
$statusErrorMsg = "";
$inStockErrorMsg = "";

if(isset($_POST['submit']))
{
    $validForm = true;

    //$eventID = $_POST['event_id'];
    $name = $_POST['product_name'];
    $desc = $_POST['product_description'];
    $price = $_POST['product_price'];
    $image = $_POST['product_image'];
    $inStock = $_POST['product_inStock'];
    $status = $_POST['product_status'];

    $date_insert = date("Y/m/d");
    $date_update = $date_insert;

    if($_POST['honeypot'] != 0){
        $validForm = false;
        echo "unable to submit form";
    }
    //if($eventID == "")
    //{
    //    $idErrorMsg = "id required";
    //    $validForm = false;
    //}
    if($name == "")
    {
        $nameErrorMsg = "product name required";
        $validForm = false;
    }
    if($desc == "")
    {
        $descErrorMsg = "description required";
        $validForm = false;
    }
    if($price == "")
    {
        $priceErrorMsg = "price required";
        $validForm = false;
    }
    if($image == "")
    {
        $imageErrorMsg = "image file name is required";
        $validForm = false;
    }
    if($inStock == "")
    {
        $inStockErrorMsg = "stock status required";
        $validForm = false;
    }
    if($validForm)
    {

        //connect to the database
        require 'connectPDO.php';
        //prepare statement
        $sql = "INSERT INTO wdv341_products (product_name,product_description,product_price,product_image,product_inStock,product_status,product_update_date) VALUES (:name, :desc, :price, :image, :inStock, :status, :upDate)";

        $stmt = $conn->prepare($sql);

        //bind parameters
        //$stmt->bindParam(':eventID', $eventID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc',$desc);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':image',$image);
        $stmt->bindParam(':inStock',$inStock);
        $stmt->bindParam(':status',$status);
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
    <link href="portfolioSass.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <title>Products Page Form</title>
</head>
<style>
    body{
        background-color: limegreen;
    }

</style>
<body style="background-color: background-color: #aaaaaa;">
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
if($validForm)
{
    echo "<div class='formLogin' style='background-color: #aaaaaa; margin-left: 33%'>";
    echo "Product Added!";
    echo "<br>";
    echo "<br>";
    echo "<a href='login.php' class='button'> Back to Admin </a>";
    echo "</div>";
}
else{
    ?>
    <form action="eventsForm.php" method="post" style="margin-left: 33%; width: 550px; height: 650px; text-align: center; background-color: grey" class="formLogin">


        <label for="product_name" style="color: white">product_name</label>
        <input type="text" name="product_name" id="product_name" placeholder="Name" value = "<?php echo $name;?>">
        <span><?php echo $nameErrorMsg;?></span><br>

        <label for="product_description" style="color: white">product_description</label>
        <input type="text" name="product_description" id="product_description" value = "<?php echo $desc;?>">
        <span><?php echo $descErrorMsg;?></span><br>

        <label for="product_price" style="color: white">product_price</label>
        <input type="dollar" name="product_price" id="product_price" value = "<?php echo $price;?>">
        <span><?php echo $priceErrorMsg;?></span><br>

        <label for="product_image" style="color: white">product_image</label>
        <input type="text" name="product_image" id="product_image" value = "<?php echo $image;?>">
        <span><?php echo $imageErrorMsg;?></span><br>


        <label for="product_inStock" style="color: white">inStock</label>
        <input type="number" name="product_inStock" id="product_inStock" value = "<?php echo $inStock;?>">
        <span><?php echo $inStockErrorMsg;?></span><br>

        <label for="product_status" style="color: white">product_status</label>
        <input type="text" name="product_status" id="product_status" value = "<?php echo $status;?>">
        <span><?php echo $statusErrorMsg;?></span><br>

        <label for="product_update_date" style="color: white">date_update</label>
        <input type="date" name="product_update_date" id="product_update_date" value = "<?php echo $date_update;?>">
        <span><?php echo $inStockErrorMsg;?></span><br>

        <input style="display:none" type="text" name="honeypot" value = 0>

        <input type="submit" class="button" name="submit" id="submit" class="button"><br>
    </form>
    <?php
}
?>

<br>
<br>
<br>
</body>

</html>
