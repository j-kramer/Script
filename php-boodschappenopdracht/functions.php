<?php

function urlIs(string $url) {
    return strcmp($url, $_SERVER["REQUEST_URI"]) == 0;
}

?>