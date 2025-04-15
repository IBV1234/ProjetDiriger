<?php

function getBasePath(): string {
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $basePath = rtrim($scriptName, '/');
    return $basePath;
}

function urlPath(): string {
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = parse_url($url, PHP_URL_PATH);

    $basePath = getBasePath();
    if (str_starts_with($urlParts, $basePath)) {
        $urlParts = substr($urlParts, strlen($basePath));
    }

    $normalizedPath = '/' . ltrim($urlParts, '/');
    return $normalizedPath;
}

function route(string $route, array $params = null): void {
    $routeValid = false;

    $basePath = getBasePath();
    $normalizedRoute = str_replace($basePath, '', $route);

    if (array_key_exists($normalizedRoute, ROUTES)) {
        $controllerFile = 'controllers/' . ROUTES[$normalizedRoute];

        if (file_exists($controllerFile)) {
            $routeValid = true;
            require $controllerFile;
        }
    }

    if (!$routeValid) {
        require 'views/page-not-found.php';
    }
}

function redirect(string $url): void {
    $basePath = getBasePath();
    header('location: ' . $basePath . $url);
    exit;
}

function redirectWitParams(string $path, $param): void {
    $basePath = getBasePath();
    if ($param != null) {
        $path .= "?param=" . urlencode($param);
    }
    header('location: ' . $basePath . $path);
    exit;
}