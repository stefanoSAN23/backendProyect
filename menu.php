<?php
    session_start();
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_for_dishes","*");
    if (!isset($_SESSION["isLoggedIn"])) {
        // Redirige al usuario al inicio de sesión si no ha iniciado sesión
        header("location: login.php");
        exit(); // Asegura que el script no continúe ejecutándose después de la redirección
    }
    
    // ... Resto de tu código para mostrar el menú ...
    
    // Verifica si se ha enviado un ID de platillo a través de GET
    if (isset($_GET['id'])) {
        $dishId = $_GET['id'];
    
        // Obtén la información del platillo desde la base de datos
        $dish = $database->select("tb_for_dishes", [
            "[>]tb_for_categories" => ["id_category" => "id_category"]
        ], [
            "tb_for_dishes.id_dish",
            "tb_for_dishes.dish_name",
            "tb_for_dishes.dish_price",
        ], [
            "id_dish" => $dishId
        ]);
    
        // Verifica si el platillo existe
        if (!empty($dish)) {
            // Puedes mostrar información adicional del platillo aquí
            echo "<p>Selected Dish: " . $dish[0]["dish_name"] . "</p>";
        }
    }
     
    
?>
  
<!DOCTYPE html>
<html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Menu</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="./css/main.css">
        </head>

    <body>
       <header>
        <nav class="top-nav">
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>

            <p class="nav-title">Shípǔ</p>

            <!--mobile nav btn (camping extracted)-->
            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span>

                </span>
            </label>

            <!--Navigation List-->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.php">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.php">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.php">CART</a></li>
                <li><a class="nav-list-link" href="./register.php">SIGN UP</a></li>
                <?php 
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

    <main>


        <div class="menu-bg-container">
            <h2 class="menuText">MENU</h2>
            <p class="phras-text">"Gastronomy is the art of using food to create happiness"</p>
        </div>

    

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Appetizers</h2>
        </div>

        <div class="menu">

        <div class="menu">

            <?php
                    foreach ($items as $item) {
                    if ($item["id_category"] == 1) {

                    echo "<div class='food-items'>";
                    echo "<img class='dish_image' src='./imgs/imgs2/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
                    echo "<div class='details'>";
                    echo "<div class='details-sub'>";
                    echo "<h5>" . $item["dish_name"] . "</h5>";
                    echo "<h5 class='price'>$" . $item["dish_price"] . "</h5>";
                    echo "</div>";
                    echo "<p>" . substr($item["dish_description"], 0, 160) . "...</p>";
                    echo "<a class='order-now' href='dishInfo.php?id=" . $item["id_dish"] . "'>Order NOW!</a>";
                    echo "</div>";
                    echo "</div>";

                    }}
                    ?>
        </div>

        </div>

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Main Dishes</h2>
        </div>

        <div class="menu">



        <div class="menu">

        <?php
                    foreach ($items as $item) {
                    if ($item["id_category"] == 2) {

                    echo "<div class='food-items'>";
                    echo "<img class='dish_image' src='./imgs/imgs2/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
                    echo "<div class='details'>";
                    echo "<div class='details-sub'>";
                    echo "<h5>" . $item["dish_name"] . "</h5>";
                    echo "<h5 class='price'>$" . $item["dish_price"] . "</h5>";
                    echo "</div>";
                    echo "<p>" . substr($item["dish_description"], 0, 160) . "...</p>";
                    echo "<a class='order-now' href='dishInfo.php?id=" . $item["id_dish"] . "'>Order NOW!</a>";
                    echo "</div>";
                    echo "</div>";

                    }}
                    ?>
                     </div>

        </div>

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Desserts</h2>
        </div>
        <div class="menu">
                   
        <?php
                    foreach ($items as $item) {
                    if ($item["id_category"] == 3) {

                    echo "<div class='food-items'>";
                    echo "<img class='dish_image' src='./imgs/imgs2/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
                    echo "<div class='details'>";
                    echo "<div class='details-sub'>";
                    echo "<h5>" . $item["dish_name"] . "</h5>";
                    echo "<h5 class='price'>$" . $item["dish_price"] . "</h5>";
                    echo "</div>";
                    echo "<p>" . substr($item["dish_description"], 0, 160) . "...</p>";
                    echo "<a class='order-now' href='dishInfo.php?id=" . $item["id_dish"] . "'>Order NOW!</a>";
                    echo "</div>";
                    echo "</div>";

                     }}
                    ?>
               </div>

        <div class="cta-menu-icon">
            <h2 class="menuTxtCategories">Beverages</h2>
        </div>
        <div class="menu">
        <?php
                    foreach ($items as $item) {

                    if ($item["id_category"] == 4) {
                    echo "<div class='food-items'>";
                    echo "<img class='dish_image' src='./imgs/imgs2/" . $item["dish_image"] . "' alt='" . $item["dish_name"] . "'>";
                    echo "<div class='details'>";
                    echo "<div class='details-sub'>";
                    echo "<h5>" . $item["dish_name"] . "</h5>";
                    echo "<h5 class='price'>$" . $item["dish_price"] . "</h5>";
                    echo "</div>";
                    echo "<p>" . substr($item["dish_description"], 0, 160) . "...</p>";
                    echo "<a class='order-now' href='dishInfo.php?id=" . $item["id_dish"] . "'>Order NOW!</a>";
                    echo "</div>";
                    echo "</div>";

                    }}
                    ?>

                 </div>

        <div class="img-animated-container">
            <img class="img-animated" src="./imgs/menu/animatedPic.jpg" alt="imagen Caja Comida China">
            
            <p class="menu-decoration-text">
                "Chinese food, with its ancient culinary traditions, is a magical journey that takes us through <br> an
                exquisite symphony of flavors and textures, where the balance between sweet and salty, spicy and soft,
                <br> becomes a dance on the palate that transports us to remote places and immerses us in the rich
                history and culture of this wonderful nation, reminding <br> us that food is much more than sustenance;
                it is a bridge that connects people, a form of artistic expression and a legacy that is passed <br> down
                from generation to generation, celebrating diversity and creativity in every bite."
            </p>
        </div>


    </main>


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
                <h4>Sunday to Thursday from 12:00 p.m. to 10:00 p.m. | Friday and Saturday from 12:00 p.m. to 11:00 p.m
                    <br> <br>
                    .Wi Fi <br>

                    .After Office <br>

                    .Spicy - Gluten Free - Vegetarian <br>

                    .A/C
                </h4>
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
                <a class = "download" href="#"><img src="./imgs/app-store.png" alt="Our app from App Store"></a>
                <a href="#"><img src="./imgs/google-play.png" alt="Our app from Google Play"></a>
            </div>
        </section>
        <p class="footer-legal">&copy; 2023. All rights reserved.</p>
    </footer>
</body>

</html>