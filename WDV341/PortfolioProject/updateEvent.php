<?php

//variables
    $productName = "";
    $productDesc = "";
    $productPrice = "";
    $productInStock = "";

    $productNameErrorMsg = "";
    $productDescErrorMsg = "";
    $productPriceErrorMsg = "";
    $productInStockErrorMsg = "";

    $validForm = "";


if( isset($_POST['submit'])){

    $productName = $_POST['product_name'];
    $productDesc = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productInStock = $_POST['product_inStock'];
    $eventId = $_GET['eventId'];

    $validForm = true;

    if($productName == ""){
        $productNameErrorMsg = "Product Name is required";
        $validForm = false;
    }

    if($productDesc == ""){
        $productDescErrorMsg = "Product Description is required";
        $validForm = false;
    }

    if($productPrice == ""){
        $productPriceErrorMsg = "Product Price is required";
        $validForm = false;
    }

    if($productInStock == ""){
        $productInStockErrorMsg = "Product stock amount is required";
        $validForm = false;
    }

    if( $validForm ){

        try{
            require 'connectPDO.php';


            $today = date("Y-m-d");

            $sql =  "UPDATE wdv341_products ";
            $sql .= "SET product_name = :name, product_description = :desc, product_price = :price, product_inStock = :inStock ";
            $sql .= "WHERE product_id = :eventId";


            $stmt = $conn->prepare($sql);



            $stmt->bindParam(':name',$productName);
            $stmt->bindParam(':desc',$productDesc);
            $stmt->bindParam(':price',$productPrice);
            $stmt->bindParam(':inStock', $productInStock);
            $stmt->bindParam(':eventId', $eventId);

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
    }
}
else{


    $eventId = $_GET['eventId'];        

    try{
        require_once 'connectPDO.php';

        $sql = "SELECT product_name,product_description,product_price,product_inStock FROM wdv341_products WHERE product_id = :eventId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $row=$stmt->fetch();

        $productName = $row['product_name'];
        $productDesc = $row['product_description'];
        $productPrice = $row['product_price'];
        $productInStock = $row['product_inStock'];
    }
    catch(PDOException $e)
    {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
        error_log($e->getMessage());
        error_log(var_dump(debug_backtrace()));

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
    <title>Events Update Form</title>

    <style>
        .errorMsg {
            color:red;
            font-style: italic;
        }
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
    <h1 style="background-color: #aaaaaa; text-align: center;">UPDATE PRODUCTS</h1>
<div id="castleTop" style="margin-top: -1%;"></div>
    <?php
        if($validForm){


            echo "<h3 class='formLogin' style='text-align: center; background-color: #aaaaaa; margin-left: 33%;'>
            Product has been updated.
            <br>
            <br>
            <a class='button' href='login.php'> BACK TO ADMIN PAGE</a>
            </h3>";
        }
        else{
    ?>

    <form method="post" action="updateEvent.php?eventId=<?= $eventId; ?>" class="formLogin" style="background-color: #aaaaaa; margin-left: 33%;">
        <p>
            <label for="product_name">Product Name: </label>
            <input type="text" name="product_name" id="product_name" placeholder="Name" value="<?php echo $productName; ?>">
            <span class="errorMsg"><?php echo $productNameErrorMsg; ?></span>
        </p>
        <p>
            <label for="product_description">Product Description: </label>
            <input type="text" name="product_description" id="product_description" value="<?php echo $productDesc; ?>">
            <span class="errorMsg"><?php echo $productDescErrorMsg; ?></span>
        </p>
        <p>
            <label for="product_price">Product Price: </label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $productPrice; ?>">
            <span class="errorMsg"><?php echo $productPriceErrorMsg; ?></span>
        </p>
        <p>
            <label for="product_inStock">Product in stock: </label>
            <input type="text" name="product_inStock" id="product_inStock" value="<?php echo $productInStock; ?>">
            <span class="errorMsg"><?php echo $productInStockErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="Submit" name="submit" class="button">
            <input type="reset" value="Try Again" class="button">
        </p>
    </form>
    <?php
            }
    ?>
    
</body>
</html>
