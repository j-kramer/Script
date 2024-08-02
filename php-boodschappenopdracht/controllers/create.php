<?php
require "functions.php";

require "config.php";
require "database.php";
require "validator.php";

$database = new Database($database_config["source"], $database_config["username"], $database_config["password"]);
$validator = new Validator();

$formdata = [
    "name" => null,
    "amount" => null,
    "price" => null,
    "validName" => true,
    "validAmount" => true,
    "validPrice" => true
];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $formdata["name"] = htmlspecialchars($_POST['name']);
    $formdata["amount"] = (int)$_POST['amount'];
    $formdata["price"] = (float)$_POST['price'];
    $formdata["validName"] = $validator->string($formdata["name"], max: 20);
    $formdata["validAmount"] = $validator->integer($formdata["amount"], 0);
    $formdata["validPrice"] = $validator->decimal($formdata["price"], 0, 100);
    if ($formdata["validName"] &&
        $formdata["validAmount"] &&
        $formdata["validPrice"]) {
        $database->addProduct($formdata["name"], $formdata["amount"], $formdata["price"]);
        header("Location: /");
        exit;
    }
}

require "views/create.view.php";