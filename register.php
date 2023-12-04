<?php
    require_once './database.php';
    $message = "";
    $messageLogin = "";

    if($_POST){

        if(isset($_POST["register"])){
            //validate if user already registered
            $validateUsername = $database->select("tb_for_clients","*",[
                "username"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);
                $database->insert("tb_for_clients",[
                    "fullname"=> $_POST["fullname"],
                    "username"=> $_POST["username"],
                    "password"=> $pass, 
                    "email_address"=> $_POST["email"]
                ]);

              //  header("location: book.php?id=".$_POST["register"]);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Restaurant</title>
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
    <main>
        <div class="register-container">

            <h2 class="register-welcome">Welcome!</h2>
            
            <form method="post" action="register.php" class="register-form">
                
            <div class='form-items'>
                    <div>
                        <label for="fullname" class="lb-register">FullName:</label>
                    </div>
                    <div>
                        <input id="fullname" name="fullname" class="inpt-register" type="text" placeholder="">
                    </div>
            </div>
            <div class='form-items'>
                    <div>
                        <label for="email" class="lb-register">Email:</label>
                    </div>
                    <div>
                        <input id="email" name="email" class="inpt-register" type="text" placeholder="">
                    </div>
                    <div>
            </div>
            <div class='form-items'>
                        <label for="username" class="lb-register">Username:</label>
                    </div>
                    <div>
                        <input id="username" name="username" class="inpt-register" type="text" placeholder="">
                    </div>
            </div>
            <div class='form-items'>
                    <div>
                        <label for="password" class="lb-register">Password:</label>
                    </div>
                    <div>
                        <input id="password" name="password" class="inpt-register" type="password" placeholder="">
                    </div>
            </div>
                    <div>
                    <input class='btn-register btn' type='submit' value="REGISTER">
                    </div>
                <p><?php echo $message; ?></p>
                        <input type="hidden" name="register" value="1">
            </form>
            

            <a class="link-login" href="./login.php">Already have an account?</a>

        </div>
    </main>
</body>

</html>