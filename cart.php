<?php
session_start();
require_once './database.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["isLoggedIn"])) {
    // Redirige al usuario al inicio de sesión si no ha iniciado sesión
    header("location: login.php");
    exit(); // Asegura que el script no continúe ejecutándose después de la redirección
}

// Verifica si se ha enviado una solicitud para limpiar el carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clearCart'])) {
    // Limpia completamente el carrito de la sesión
    $_SESSION['cart'] = [];
}

// Verifica si se ha enviado un ID de platillo a través de GET
if (isset($_GET['id'])) {
    $dishId = $_GET['id'];

    // Verifica si el carrito ya existe en la sesión
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verifica si el platillo ya está en el carrito
    $existingCartItem = array_filter($_SESSION['cart'], function ($item) use ($dishId) {
        return $item['id'] == $dishId;
    });

    // Si el platillo no está en el carrito, agrégalo
    if (empty($existingCartItem)) {
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
            $_SESSION['cart'][] = [
                'id' => $dish[0]["id_dish"],
                'name' => $dish[0]["dish_name"],
                'price' => $dish[0]["dish_price"],
            ];
        }
    }

    // Redirige a la página del carrito después de añadir el platillo
    header("location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css"> 

   
</head>
<body class="backgroundRegister">
    
   
    <header>
        <!-- top navigation bar -->
        <nav class="top-nav">
            <!-- Logo and title -->
            <a href="./index.php"><img class="logo" src="./imgs/logoOscuro.png" alt="Shipu Logo"></a>
            <p class="nav-title">Shípǔ</p>

            <!--Mobile Menu Button (Controlled by Checkbox) -->
            <input class="mobile-cb" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>

            <!-- Navigation list-->
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

    <!-- Main content -->
    <main>
    <div class="order-container">
            <h2>Your Cart</h2>
            <?php
            // Verifica si hay platillos en el carrito
            if (!empty($_SESSION['cart'])) {
                // Itera sobre los platillos en el carrito
                foreach ($_SESSION['cart'] as $cartItem) {
                    // Obtén la información del platillo desde la base de datos
                    $dish = $database->select("tb_for_dishes", [
                        "[>]tb_for_categories" => ["id_category" => "id_category"]
                    ], [
                        "tb_for_dishes.id_dish",
                        "tb_for_dishes.dish_name",
                        "tb_for_dishes.dish_price",
                    ], [
                        "id_dish" => $cartItem['id']
                    ]);

                    // Verifica si el platillo existe
                    if (!empty($dish)) {
                        // Muestra la información del platillo
                        echo "<div class='cart-item'>";
                        echo "<p>Name: " . $dish[0]['dish_name'] . "</p>";
                        echo "<p>Price: $" . $dish[0]['dish_price'] . "</p>";
                        echo "</div>";
                    }
                }
                // Botón para limpiar el carrito
                echo "<form method='post'>";
                echo "<input class='btn-order-modal btn' type='submit' name='clearCart' value='Clear Cart'>";
                echo "</form>";
            } else {
                // Mensaje si el carrito está vacío
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        <!--Buttons to continue or pay the order -->
        <div class='orderBtns-container'>
        <a href='./menu.php' class='btn-order-modal btn'>Keep Ordering</a>
        <a href='#' class='btn-order-modal btn'>Accept Order</a>
       </div>
       </div>
        
    </main>
</body>
</html>
