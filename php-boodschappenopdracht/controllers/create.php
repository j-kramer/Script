<?php
include "functions.php";

include "config.php";
include "Database.php";

$database = new Database($database_config["source"], $database_config["username"], $database_config["password"]);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $database->addProduct(htmlspecialchars($_POST['name']), (int)$_POST['amount'], (float)$_POST['price']);
    header("Location: /");
    exit;
}

include "views/create.view.php";