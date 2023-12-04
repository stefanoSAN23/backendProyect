<?php
    require_once './database.php';
    $message = "";
    $messageLogin = "";

    if($_POST){

        if(isset($_POST["login"])){
            $user = $database->select("tb_for_clients", "*",[
                "username" =>$_POST["username"]
            ]);

            if (count($user) > 0){
                if (password_verify($_POST["password"], $user[0]["password"])){
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["fullname"] = $user[0]["fullname"];
                    header("location: index.php");
                } else{
                    $messageLogin = "wrong username or password";
                }
            } else{
                $messageLogin = "wrong username or password";
            }
           
        }
    }
?>

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

    <!--Register-->
    <main>
        <div class="register-container">
            <h2 class="register-welcome">Welcome!</h2>

            <form method="post" action="login.php" class="register-form">
                <div>
                <label for="username" class="lb-register">Username:</label>
                </div>
                <div>
                <input id="username" name="username" class="inpt-register" type="text" placeholder="">
                </div>
                <div>
                <label for="password" class="lb-register">Password:</label>
                </div>
                <div>
                <input id="password" name="password" class="inpt-register" type="password" placeholder="">
                </div>
                <div>
                <input class='btn-login btn' type='submit' value="LOGIN">
                </div>
                        <p><?php echo $messageLogin; ?></p>
                        <input type="hidden" name="login" value="1">
                
            </form>
            
            <a class="link-register" href="./register.php">Don't have any account?</a>

        </div>
    </main>
</body>

</html>