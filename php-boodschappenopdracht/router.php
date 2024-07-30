<?php
require "routes.php";

function routeToController(string $uri, array $routes) {
    if (array_key_exists($uri,$routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort() {
    require "views/404.php";
    die();
}
?>