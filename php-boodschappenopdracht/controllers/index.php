<?php
include "functions.php";
include "config.php";
include "Database.php";

$database = new Database($database_config["source"], $database_config["username"], $database_config["password"]);
$groceries = $database->query("SELECT name, amount, price FROM groceries")->fetchAll();

function sum($carry, $item) {
    [, $amount, $price] = $item;
    $carry += $amount * $price;
    return $carry;
}

$totalprice = array_reduce($groceries, "sum");

include "views/index.view.php";
