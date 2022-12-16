<?php

session_start();

if(isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link href="./css/reset.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <header class="container">
        <div class="signup-container">
            <h1 class="title">Empresa Oliveira Trade</h1>
            <?php if(isset($user)): ?>                
                <a class="signup" href="logout.php">Log out</a>            
            <?php endif; ?>            
        </div>       
    </header>

    <section class="banner">             
            <h2 class="banner-title">HOME</h2>            
    </section>

    <main class="main-container">
        <div>
            <?php if(isset($user)): ?>
                <h3 class="main-title">Olá, <?= $user["full_name"] ?>!</h3> 
                <h3 class="main-title">Você está logado.</h3>                
            <?php else: ?>
                <h3 class="main-title">Olá!!!</h3>                
                <a class='main-link' href="login.php">Log in</a>                
                <a class='main-link' href="signup.html">Sign up</a>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>