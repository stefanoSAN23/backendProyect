<?php 
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    // tb_dishes and tb_categories JOIN
    $lang = "CH";
    $url_params = "";

    if($_GET){
        // Reference: https://medoo.in/api/where
        /*$item = $database->select("tb_destinations","*",[
            "id_destination"=>$_GET["id"]
        ]);*/

        // Reference: https://medoo.in/api/select
        // Note: don't delete the [>] 
        if(isset($_GET["lang"]) && $_GET["lang"] == "ch"){
            $dishes = $database->select("tb_for_dishes",[
                "[>]tb_for_categories"=>["id_category" => "id_category"]
            ],[
                "tb_for_dishes.id_dish",
                "tb_for_dishes.dish_name_chinese",
                "tb_for_dishes.dish_description_chinese",
                "tb_for_dishes.dish_image",
                "tb_for_dishes.dish_price",
                "tb_for_categories.name_category",
                "tb_for_categories.description_category",
            ],[
                "id_dish"=>$_GET["id"]
            ]); 

            //references
            $dishes [0]["dish_name"] = $dishes [0]["dish_name_chinese"] ;
            $dishes [0]["dish_description"] = $dishes [0]["dish_description_chinese"];

            $lang = "EN";
            $url_params = "?id=".$dishes [0]["id_dish"];

        }else{
            $dishes  = $database->select("tb_for_dishes",[
                "[>]tb_for_categories"=>["id_category" => "id_category"]
            ],[
                "tb_for_dishes.id_dish",
                "tb_for_dishes.dish_name",
                "tb_for_dishes.dish_name_chinese",
                "tb_for_dishes.dish_description_chinese",
                "tb_for_dishes.dish_description",
                "tb_for_dishes.dish_image",
                "tb_for_dishes.dish_price",
                "tb_for_categories.name_category",
                "tb_for_categories.description_category",
            ],[
                "id_dish"=>$_GET["id"]
            ]);
           
            $lang = "CH";
            $url_params = "?id=".$dishes [0]["id_dish"]."&lang=ch";
        }
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Info Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css"> 

    <!--This is the beginning of the header -->
</head>
<body class="backgroundDishInfo">
    <!-- Start of the body of page -->

    <!-- Page Header -->
    <header>
        <!-- Top navigation bar -->
        <nav class="top-nav">
            <!--Logo and title -->
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!-- Mobile Menu Button (Controlled by Checkbox) -->
            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>

            <!-- navigation list -->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.php">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.php">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.php">CART</a></li>
                <li><a class="nav-list-link" href="./register.php">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.php">LOGIN</a></li>
            </ul>
        </nav>
    </header>

    <!-- main content  -->
    <main>
    <?php


       echo "<div class='dishInfo-container'>";
            echo "<h2>" . $dishes[0]["dish_name"] . "</h2>";
            
            echo "<!-- info and Image container -->";
           echo  "<div class='infoImageDish'>";
               echo "<img class='infoImage' src='./imgs/imgs2/" . $dishes[0]["dish_image"] . "' alt='dishImage'>";
               echo "<a href='dishInfo.php".$url_params."'>".$lang."</a>";
                echo "<!-- Image-->";
               echo  "<p>" . $dishes[0]["dish_description"] . " </p>";
               
               
           echo "</div>";

            
            echo "<div class='dishInfoDetails'>";
                echo "<h5>Main Dish</h5>";
                echo "<h5>Related Dishes</h5>";
                echo "<h5>Featured Dish</h5>"; 
                echo "<img class='icon-persons' src='./imgs/familiar.png' alt='familiar'>";

           echo "</div>";

           
           echo "<div class='infoPrice'>";
               echo "<p>" .  $dishes[0]["dish_price"] . "</p>"; 
               echo "<a href='./menu.php' class='btn-order-dish btn'>Go To Menu</a>"; 
               echo "<a href='#' class='btn-order-dish btn'>Add To Cart!</a>"; 
           echo "</div>";
        echo "</div>";
        
        ?>
    </main>
</body>
</html>