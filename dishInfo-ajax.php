<?php 
    require_once './database.php';

    if($_GET){
      
        $dishes = $database->select("tb_for_dishes",[
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
                <?php 
                session_start();
                if (isset($_SESSION["isLoggedIn"])){
                    echo "<li><a class='nav-list-link' href='profile.php'>".$_SESSION["fullname"]."</a></li>";
                    echo "<li><a class='nav-list-link' href='logout.php'>Logout</a></li>";
                }else {
                    echo " <li><a class='nav-list-link' href='./login.php'>Login</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <!-- main content  -->
    <main>
    <?php


       echo "<div class='dishInfo-container'>";
            echo "<h2><span id='dish-name'>". $dishes[0]["dish_name_chinese"] . "</span></h2>";
            
            echo "<!-- info and Image container -->";
           echo  "<div class='infoImageDish'>";
               echo "<img class='infoImage' src='./imgs/imgs2/" . $dishes[0]["dish_image"] . "' alt='dishImage'>";
                echo "<!-- Image-->";
               echo  "<p id='dish-name'>". $dishes[0]["dish_description_chinese"] . " </p>";
               echo "<span id='lang' class='lang-btn' onclick='getTranslation(".$dishes[0] ["id_dish"].")'>CH</span>";
               
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
    <script>

let requestLang = "ch";

function switchLang(){
    if(requestLang == "en") requestLang = "ch";
    else requestLang = "en";
    document.getElementById("lang").innerText = requestLang;
}

function getTranslation(id){
    console.log(id);

    let info = {
        id_dish: id,
        language: requestLang 
    };

    //fetch
    fetch("http://localhost/backendProyectoShipu/language.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            'Accept': "application/json, text/plain, */*",
            'Content-Type': "application/json"
        },
        body: JSON.stringify(info)
    })
    .then(response => response.json())
    .then(data => {
        //console.log(data);
    switchLang();
    document.getElementById("dish-name").innerHTML = data.name;
    document.getElementById("dish-description").innerHTML = data.description;

    })
    .catch(err => console.log("error: " + err));
}
</script>
</body>
</html>