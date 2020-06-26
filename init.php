<?php

//starte die session funktionen
session_start();


// require alle klassen. __DIR__ gibt den aktuellen ordner zurück.
spl_autoload_register(function ($class) {
    $path = __DIR__ . "/classes/$class.php";
    require_once $path;
    // echo "loaded class $path <br>";
});


//output buffering: html erst am schluss senden. Ermöglicht senden von headers irgendwo im code
ob_start();


function redirect($url = "", $exit = true)
{
    header("Location: $url");
    if ($exit) {
        exit;
    }
}

/**
 * Hilfsfunktion für das formatieren von einem datum
 *
 * @param $date string datum
 * @param $target_format string zielformat des datums
 * @return string the formatted date
 */
function formatDate($date, $target_format = 'd.m.Y')
{
    $dateTime = new DateTime($date);
    return $dateTime->format($target_format);
}


function dump($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}
