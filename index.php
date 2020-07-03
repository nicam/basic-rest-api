<?php

require "init.php";
require "api.php";

$method = getMethod();
$resource = getResource();
$identifier = getIdentifier();
$query = getQuery();

switch ($resource) {
  case 'genres':
    $controller = GenreController::get();
    switch ($method) {
      case 'GET':
        if ($identifier) {
          return $controller->getOne($identifier);
        }
        return $controller->getAll($query);
      case 'POST':
        $postBody = getPostBody();
        return $controller->create($postBody);
      case 'DELETE':
        return $controller->delete($identifier);
      case 'PUT':
        $postBody = getPostBody();
        return $controller->update($identifier, $postBody);
      case 'OPTIONS':
        return $controller->sendCorsHeaders();
      default:
        echo 'Invalid Method';
    }
}

