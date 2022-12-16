<?php

print_r($_POST);

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("É necessário um email válido.");
}

if (strlen($_POST["password"]) < 8) {
    die("A senha deve ter pelo menos 8 caracteres.");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("A senha deve ter pelo menos 1 letra.");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("A senha deve ter pelo menos 1 número.");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("As senhas devem ser iguais.");
}

if (is_null($_POST['full_name'])) {
    die("O campo nome deve ser preenchido.");
}

if (strlen($_POST["cpf"]) != 14) {
    die("CPF inválido.");
}

if (strlen($_POST["rg"]) < 5) {
    die("RG inválido.");
}

if (is_null($_POST['birthday'])) {
    die("O campo data de nascimento deve ser preenchido.");    
}

if (is_null($_POST['phone'])) {
    die("O campo telefone deve ser preenchido.");    
}

if (strlen($_POST["cep"]) != 8) {
    die("CEP inválido.");
}

if (is_null($_POST['street'])) {
    die("O campo logradouro deve ser preenchido.");    
}

if (is_null($_POST['house_number'])) {
    die("O campo número deve ser preenchido.");    
}

if (is_null($_POST['district'])) {
    die("O campo bairro deve ser preenchido.");    
}

if (is_null($_POST['city'])) {
    die("O campo cidade deve ser preenchido.");    
}

if (is_null($_POST['country_state'])) {
    die("O campo estado deve ser preenchido.");    
}


$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (email, password_hash, full_name, cpf, rg, birthday, phone, cep, street, house_number, complement, district, city, country_state)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssssssssssss",                  
                  $_POST["email"],
                  $password_hash,
                  $_POST["full_name"],
                  $_POST["cpf"],
                  $_POST["rg"],
                  $_POST["birthday"],
                  $_POST["phone"],
                  $_POST["cep"],
                  $_POST["street"],
                  $_POST["house_number"],
                  $_POST["complement"],
                  $_POST["district"],
                  $_POST["city"],
                  $_POST["country_state"]
                );
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Email já usado.");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>