<?php
require_once './database.php';

// Obtén el id_dish de la URL
$id_dish = isset($_GET['id']) ? $_GET['id'] : null;

// Verifica si se proporcionó un id_dish válido
if ($id_dish) {
    // Realiza una consulta para obtener la información del platillo específico
    $selectedDish = $database->get("tb_for_dishes", [
        "[>]tb_for_categories" => ["id_category" => "id_category"]
    ], [
        "tb_for_dishes.id_dish",
        "tb_for_dishes.dish_name",
        "tb_for_dishes.dish_description",
        "tb_for_dishes.dish_image",
        "tb_for_dishes.dish_price",
        "tb_for_categories.id_category",
        "tb_for_categories.name_category"
    ], [
        "tb_for_dishes.id_dish" => $id_dish
    ]);

    // Verifica si se encontró el platillo
    if ($selectedDish) {
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
</head>

<body class="backgroundDishInfo">

<!-- Encabezado -->
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

<!-- Contenido principal -->
<main>
    <div class='dishInfo-container'>
        <h2><?php echo $selectedDish["dish_name"]; ?></h2>
        <div class='infoImageDish'>
            <img class='infoImage' src='./imgs/imgs2/<?php echo $selectedDish["dish_image"]; ?>' alt='dishImage'>
            <p><?php echo $selectedDish["dish_description"]; ?></p>
        </div>
        <div class='dishInfoDetails'>
            <h5>Main Dish</h5>
            <h5>Related Dishes</h5>
            <h5>Featured Dish</h5>
            <img class='icon-persons' src='./imgs/familiar.png' alt='familiar'>
        </div>
        <div class='infoPrice'>
            <p>$<?php echo $selectedDish["dish_price"]; ?></p>
            <a href='./menu.php' class='btn-order-dish btn'>Go To Menu</a>
            <a href='#' class='btn-order-dish btn'>Add To Cart!</a>
        </div>
    </div>
</main>

<!-- Pie de página -->
<footer class='footer-container'>
    <!-- Tu contenido de pie de página aquí -->
</footer>

</body>

</html>
<?php
    } else {
        // Si no se encuentra el platillo, muestra un mensaje de error o redirige a una página de error
        echo "<p>Platillo no encontrado</p>\n";
    }
} else {
    // Si no se proporciona un id_dish válido, muestra un mensaje de error o redirige a una página de error
    echo "<p>Id de platillo no proporcionado</p>\n";
}
?>
    </main>
</body>
</html>
