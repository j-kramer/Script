<?php

function urlIs(string $url): bool {
    return strcmp($url, $_SERVER["REQUEST_URI"]) == 0;
}