<?php

class BaseController
{
    protected function json($data, $statusCode = 200) {
      $this->sendCorsHeaders();
      http_response_code($statusCode);
      echo json_encode($data);
    }

    public function sendCorsHeaders()
    {
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); // Handle CORS for every route
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
}
