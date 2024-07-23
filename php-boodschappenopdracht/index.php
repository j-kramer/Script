<?php
$groceries = [
    ["Brood", 1, 1.00],
    ["Broccoli", 2, 0.99],
    ["Krentebollen", 4, 1.20],
    ["Noten", 0, 2.99]
];

function sum($carry, $item) {
    [, $amount, $price] = $item;
    $carry += $amount * $price;
    return $carry;
}

$totalprice = array_reduce($groceries, "sum");

include "index.view.php";
