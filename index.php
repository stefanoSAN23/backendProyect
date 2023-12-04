<?php 
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    // tb_dishes and tb_categories JOIN
    $dishes = $database->select("tb_for_dishes", [
        "[>]tb_for_categories" => ["id_category" => "id_category"]
    ], [
        "tb_for_dishes.id_dish",
        "tb_for_dishes.dish_name",
        "tb_for_dishes.dish_description",
        "tb_for_dishes.dish_image",
        "tb_for_dishes.dish_price",
        "tb_for_categories.id_category",
        "tb_for_categories.name_category" 
   
    ]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chinese Restaurant</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <link rel="stylesheet" href="./css/main.css">



</head>

<body>
    <header class="hero-container">
        <nav class="top-nav">
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!--mobile nav btn (camping extracted)-->

            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span>

                </span>
            </label>

            <!--Navigation list-->
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

        <!--Container of the text presentation-->
        <div class="headerTextContainer">
            <h1 class="hero-title">Enjoy Chinese food on <br>another level.</h1>
            <p class="hero-text"> Find recipes for the most delicious chinese dishes in the world.</p>
        </div>

    </header>

    <main>

        <!--<Section Two>-->

        <div class="sectionTwoContainer">

            <div class="sectionTwoCard">
                <img class="sectionTwoActivity" src="./imgs/searchFood.jpg" alt="Search">
                <div class="sectionTwoText">
                    <p>Freshness</p>
                </div>

            </div>

            <div class="sectionTwoCard">
                <img class="sectionTwoActivity" src="./imgs/createFood.jpg" alt="Create">
                <div class="sectionTwoText">
                    <p>Creative</p>
                </div>
            </div>

            <div class="sectionTwoCard">
                <img class="sectionTwoActivity" src="./imgs/findFood.jpg" alt="Find">
                <div class="sectionTwoText">
                    <p>Healthy</p>
                </div>
            </div>



            <div class="sectionTwoCard">
                <img class="sectionTwoActivity" src="./imgs/enjoyFood.jpg" alt="e">
                <div class="sectionTwoText">
                    <p>Delicious</p>
                </div>
            </div>

        </div>


        <!--<End Section Two>-->


        <div class="cta-container">
            <a href="./menu.php" class="btn go-to-menu-btn">Go to Menu</a>
        </div>


        <!--Button-->





        <!--<Section Three -->

        <section class="recipes-container">

            <div class="rice-container">
                <img class="rice-image" src="./imgs/riceAnimate.png" alt="Explore Destinations & Activities">
                <h2 class="recipes-title">Customer Favorites!</h2>
            </div>


            <!--<Section Three First Part -->

     

            <section class="food-container">

<?php 
// Verify if there are at least 4 elements in $relatedDishes
$dishesCount = count($dishes);
$numberContainers = 3;

for ($i = 0; $i < $numberContainers; $i++) {

    if ($i < $dishesCount ) {

        $dish = $dishes[$i];

   echo "<div class='card'>";

   echo  "<div class='top-card'>";

           echo "<div class='boton-modal'>";
               echo "<label for='btn-modal-uno'> BUY </label>";
            
        echo "</div>";
           echo "<input type='checkbox' id='btn-modal-uno'>";
             echo "<div class='container-modal'>";
               echo "<div class='content-modal'>";
                   echo "<div class='superior-info-modal'>";
                       echo "<h2>Fruit Salad</h2>";
                       echo "<div class='info-modal'>";
                           echo "<img class='icon-persons' src='./imgs/familiar.png' alt='modalCart'>";
                            echo "<h3>Salad with apple, papaya and watermelon</h3>";
                        echo "</div>";
                    echo "</div>";
                    echo "<img class='recipe-image' src='./imgs/menu/appetizerTwo.png' alt=''>";
                    echo "<div class='cta-price-orderNow '>";
                       echo "<a class='btn-price-modal' href=''>$12</a>";
                       echo  "<a class='btn-order-modal' href='./dishInfo.html'>Order Now!</a>";
                    echo "</div>";
                    echo "<div class='btn-close'>";
                       echo "<label for='btn-modal-uno'>Close</label>";
                    echo "</div>";
                echo "</div>";
               echo "<label for='btn-modal-uno' class='close-modal'></label>";
            echo "</div>";
        echo "</div>";
        echo "<div class='recipe-thumb'>";
            echo "<img class='recipe-image' src='./imgs/imgs2/" . $dish["dish_image"] . "' alt='RecipeOne'>";
          echo "<a class='btn recipe-name' href='dishInfo.php?id=".$dish["id_dish"]."'>" . $dish["dish_name"] . "</a>";
        echo "</div>";


    echo "</div>";

    }
}
    ?>


</section>

            <!--<End Section Three first part-->

            <!--Section Three second part-->

            <section class="food-container">

<?php 
// Verify if there are at least 4 elements in $relatedDishes
$dishesCount = count($dishes);
$numberContainers = 3;

for ($i = 0; $i < $numberContainers; $i++) {

    if ($i < $dishesCount ) {

        $dish = $dishes[$i];

   echo "<div class='card'>";

   echo  "<div class='top-card'>";

           echo "<div class='boton-modal'>";
               echo "<label for='btn-modal-uno'> BUY </label>";
            
        echo "</div>";
           echo "<input type='checkbox' id='btn-modal-uno'>";
             echo "<div class='container-modal'>";
               echo "<div class='content-modal'>";
                   echo "<div class='superior-info-modal'>";
                       echo "<h2>Fruit Salad</h2>";
                       echo "<div class='info-modal'>";
                           echo "<img class='icon-persons' src='./imgs/familiar.png' alt='modalCart'>";
                            echo "<h3>Salad with apple, papaya and watermelon</h3>";
                        echo "</div>";
                    echo "</div>";
                    echo "<img class='recipe-image' src='./imgs/menu/appetizerTwo.png' alt=''>";
                    echo "<div class='cta-price-orderNow '>";
                       echo "<a class='btn-price-modal' href=''>$12</a>";
                       echo  "<a class='btn-order-modal' href='./dishInfo.html'>Order Now!</a>";
                    echo "</div>";
                    echo "<div class='btn-close'>";
                       echo "<label for='btn-modal-uno'>Close</label>";
                    echo "</div>";
                echo "</div>";
               echo "<label for='btn-modal-uno' class='close-modal'></label>";
            echo "</div>";
        echo "</div>";
        echo "<div class='recipe-thumb'>";
            echo "<img class='recipe-image' src='./imgs/imgs2/" . $dish["dish_image"] . "' alt='RecipeOne'>";
          echo "<a class='btn recipe-name' href='dishInfo.php?id=".$dish["id_dish"]."'>" . $dish["dish_name"] . "</a>";
        echo "</div>";


    echo "</div>";

    }
}
    ?>


</section>

            <!--End Section Three second part-->



            <!--Section Three third part-->


            <section class="food-container">

            <?php 
            // Verify if there are at least 4 elements in $relatedDishes
            $dishesCount = count($dishes);
            $numberContainers = 3;

            for ($i = 0; $i < $numberContainers; $i++) {

                if ($i < $dishesCount ) {

                    $dish = $dishes[$i];

               echo "<div class='card'>";

               echo  "<div class='top-card'>";

                       echo "<div class='boton-modal'>";
                           echo "<label for='btn-modal-uno'> BUY </label>";
                        
                    echo "</div>";
                       echo "<input type='checkbox' id='btn-modal-uno'>";
                         echo "<div class='container-modal'>";
                           echo "<div class='content-modal'>";
                               echo "<div class='superior-info-modal'>";
                                   echo "<h2>Fruit Salad</h2>";
                                   echo "<div class='info-modal'>";
                                       echo "<img class='icon-persons' src='./imgs/familiar.png' alt='modalCart'>";
                                        echo "<h3>Salad with apple, papaya and watermelon</h3>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<img class='recipe-image' src='./imgs/menu/appetizerTwo.png' alt=''>";
                                echo "<div class='cta-price-orderNow '>";
                                   echo "<a class='btn-price-modal' href=''>$12</a>";
                                   echo  "<a class='btn-order-modal' href='./dishInfo.html'>Order Now!</a>";
                                echo "</div>";
                                echo "<div class='btn-close'>";
                                   echo "<label for='btn-modal-uno'>Close</label>";
                                echo "</div>";
                            echo "</div>";
                           echo "<label for='btn-modal-uno' class='close-modal'></label>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='recipe-thumb'>";
                        echo "<img class='recipe-image' src='./imgs/imgs2/" . $dish["dish_image"] . "' alt='RecipeOne'>";
                      echo "<a class='btn recipe-name' href='dishInfo.php?id=".$dish["id_dish"]."'>" . $dish["dish_name"] . "</a>";
                    echo "</div>";


                echo "</div>";

                }
            }
                ?>


            </section>
            <!--End Section Three third part-->

        </section>


        <!--End Section Three-->


        <!--register invitation-->
        <div class="register-invitation-cta">
            <section class="register-invitation-content">
                <h2 class="register-invitation-title">Register and order our delicious dishes!</h2>
                <a href="./register.php" class="btn register-invitation-btn">Register</a>
            </section>
            <div>
                <img class="register-invitation-image" src="./imgs/register-invitation-img.jpg"
                    alt="register invitation">
            </div>
        </div>
        <!--register invitation end-->


        <!--map-->
        <div class="map-container">
            <h2 class="menuTxtCategories">We are located here!</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d429.0818357526553!2d114.23657986179725!3d30.643688028081247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x342eabdfd9babf75%3A0x8063af3254ea95e6!2z5q2m5rGJ5ZCN54Of5Z-O!5e0!3m2!1ses!2scr!4v1697699594030!5m2!1ses!2scr"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!--end map-->

    </main>



    <!--footer-->

     <footer class="footer-container">
        <div class="footer-content">
            <section>
                <h3 class="footer-decoration">Shipú Online Restaurant</h3>
                <p>Welcome to Shipú, the groundbreaking virtual Chinese restaurant that brings the flavors of
                    China
                    to your doorstep! At Shipú, we combine authentic Chinese cuisine with modern culinary
                    techniques
                    to craft an array of delectable dishes that will transport you to the heart of China </p>
            </section>
            <div class="footer-schedule">
                    <h3 class="footer-decoration">Schedule and Services</h3>
                    <h4>Sunday to Thursday from 12:00 p.m. to 10:00 p.m. | Friday and Saturday from 12:00 p.m. to 11:00 p.m <br> <br>
                        .Wi Fi <br>

                        .After Office <br>
                        
                        .Spicy - Gluten Free - Vegetarian <br> 
                        
                        .A/C </h4>
            </div>
            <div class="footer-links">
                <section>
                    <h3 class="footer-decoration">Follow us on:</h3>
                    <div class="cta-app-container">
                        <a href="https://www.instagram.com"><img class="instagram" src="./imgs/instagram.png"
                                alt="instagram"></a>
                        <a href="https://www.facebook.com"><img class="facebook" src="./imgs/facebook.png"
                                alt="facebook"></a>
                        <a href="https://www.twitter.com"><img class="twitter" src="./imgs/twitter.png"
                                alt="twitter"></a>

                    </div>

                </section>
            </div>
            
        </div>
        <section class="download-app">
            <h3>Download our App</h3>
            <div class="cta-app-container">
                <a href="#"><img src="./imgs/app-store.png" alt="Our app from App Store"></a>
                <a href="#"><img src="./imgs/google-play.png" alt="Our app from Google Play"></a>
            </div>
        </section>
        <p class="footer-legal">&copy; 2023. All rights reserved.</p>
    </footer>
    
      <!--End footer-->

       <!--Javascript connection -->
    <script src="main.js"></script>


</body>

</html>