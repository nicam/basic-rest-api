<?php

function getPath() {
  // Generiert aus http://localhost/php_vertiefung/rest/genres/5 => genres/5
  // $_SERVER['DOCUMENT_ROOT'] => /Applications/MAMP/htdocs
  // __DIR__ => /Applications/MAMP/htdocs/php_vertiefung/rest
  // __DIR__ - $_SERVER['DOCUMENT_ROOT'] => php_vertiefung/rest (baseURL)
  // $_SERVER['REQUEST_URI'] => /php_vertiefung/rest/genres/1
  // $_SERVER['REQUEST_URI'] - $baseURL => Path (genres/1)
  $dir = str_replace('\\', '/', __DIR__);
  $baseUrl = str_replace($_SERVER['DOCUMENT_ROOT'], '', $dir);
  $path = str_replace($baseUrl, '', $_SERVER['REQUEST_URI']);
  return $path;
}

function getMethod() {
  return $_SERVER["REQUEST_METHOD"];
}

function getIdentifier() {
  $path = getPath();
  $parts = explode('/', trim($path, '/'));
  $lastElement = end($parts);
  if (is_numeric($lastElement)) {
    return (int)$lastElement;
  }
  return null;
}

function getResource() {
  $path = getPath();
  $parts = explode('/', trim($path, '/'));
  if (empty($parts)) {
    return null;
  }
  return $parts[0];
}

function getQuery() {
  return $_REQUEST;
}

function getPostBody()
{
  if ($_SERVER["CONTENT_TYPE"] !== 'application/json') {
    throw new Exception('Content type must be: application/json');
  }

  //Post Body auslesen
  $content = trim(file_get_contents("php://input"));

  //JSON in Array umwandeln.
  $data = json_decode($content, true);
  return $data;
}