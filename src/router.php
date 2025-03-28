<?php

function urlPath() : string {
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = parse_url($url,PHP_URL_PATH);
    return $urlParts;

}
function route(string $route, array $params = null) : void 
{
    $routeValid = false;

    if (array_key_exists($route, ROUTES)) {

        $controllerFile = 'Controllers/' . ROUTES[$route];

        if (file_exists($controllerFile)) {

            $routeValid = true;
            require $controllerFile;

        }

    }

    if (!$routeValid) {
        require 'views/page-not-found.php';
    }

}

function redirect(string $url) : void 
{
    header('location: '. $url);
    exit;
}

function redirectWitParams(string $path, $param): void
{
    if ($param != null) {
        $path .= "?param=" . urlencode($param);
    }
    header('Location: ' . $path);
    exit;

}