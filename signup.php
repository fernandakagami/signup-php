<?php

if (empty($_POST["name"])) {
    die("Nome é obrigatório.");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Email válido é obrigatório.");
}

if (strlen($_POST["password"]) < 8) {
    die("A senha deve ter pelo menos 8 caracteres.");
}

if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("A senha deve conter pelo menos uma letra.");
}

if (! preg_match("/[0-9]/i", $_POST["password"])) {
    die("A senha deve conter pelo menos um número.");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("As senhas não são iguais.");
}

print_r($_POST);

?>