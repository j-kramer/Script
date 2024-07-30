<?php
include "routes.php";

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