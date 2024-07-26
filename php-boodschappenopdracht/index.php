<?php
include "router.php";
routeToController($_SERVER["REQUEST_URI"], $routes);