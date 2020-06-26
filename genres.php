<?php

require "init.php";
require "api.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri ); // use list to extract identifier and path here

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
  case 'GET':
    $repository = GenreRepository::get();
    $tasks = $repository->getAll();
    return json($tasks);
  break;
  case 'POST':
  break;
  case 'DELETE':
  break;
  case 'PUT':
  break;
}