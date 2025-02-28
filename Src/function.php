<?php

function Uripath(){

    $url = $_SERVER['REQUEST_URI'];
    $urlParts = parse_url($url,PHP_URL_PATH);
    return $urlParts;
}

function routeController( string $path){

    $valideRouteController = false;
    if(array_key_exists($path,ROUTES)){
        $filePath = 'Controllers/' .ROUTES[$path];

        if(file_exists($filePath)){

            $valideRouteController = true;
            require $filePath;
        }

    }

    if(!$valideRouteController){

        require 'Controllers/error.php';
    }
}

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
 function redirect($path){

    header('Location: ' . $path);
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
 

