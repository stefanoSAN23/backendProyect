<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body class="backgroundRegister">

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

            <!--Navigation list-->
            <ul class="nav-list">
                <li><a class="nav-list-link" href="./history.php">USER HISTORY</a></li>
                <li><a class="nav-list-link" href="./menu.php">MENU</a></li>
                <li><a class="nav-list-link" href="./cart.php">CART</a></li>
                <li><a class="nav-list-link" href="./register.php">SIGN UP</a></li>
                <li><a class="nav-list-link" href="./login.php">LOGIN</a></li>
            </ul>


        </nav>
    </header>

    <!--Register-->
    <main>
        <div class="register-container">
            <h2 class="register-welcome">Welcome!</h2>

            <form class="register-form">
                <label class="lb-register">FullName:</label>
                <input class="inpt-register" type="text" placeholder="">
            </form>
            <form class="register-form">
                <label class="lb-register">Email:</label>
                <input class="inpt-register" type="text" placeholder="">
            </form>

            <a href="#" class="btn-login btn">Log In</a>

            <a class="link-register" href="./register.php">Don't have any account?</a>

        </div>
    </main>
</body>

</html>