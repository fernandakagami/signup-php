<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <a class="signup" href="signup.html">Sign up</a>
        </div>       
    </header>

    <section class="banner">             
            <h2 class="banner-title">LOGIN</h2>            
    </section>

    <?php if ($is_invalid): ?>
        <em>Email inválido</em>
    <?php endif; ?>


    <main class="main-container">
        <form class="main-form" method="post">
            <fieldset>                    
                <div class="field-form">
                    <label class="label-form" for="email">Email</label>
                    <input class="input-form" type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                </div>
                <div class="double-field">
                    <div class="field-form">
                        <label class="label-form" for="password">Senha</label>
                        <input class="input-form" type="password" id="password" name="password" required>
                    </div>                
                </div>                    
            </fieldset>
            <button type='submit'>Login</button>
        </form>
    </main>
</body>
</html>