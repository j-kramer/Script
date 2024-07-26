<?php
$routes = [
    "/" => "controllers/index.php",
    "/create" => "controllers/create.php"
];

function routeToController(string $uri, array $routes) {
    if (array_key_exists($uri,$routes)) {
        include $routes[$uri];
    } else {
        abort();
    }
}

function abort() {
    include "views/404.php";
    die();
}
?>