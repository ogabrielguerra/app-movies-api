<?php
namespace www\classes;

class CorsHandler{

    function __construct($server) {

        if (isset($server['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$server['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        
        if ($server['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($server['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
            if (isset($server['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$server['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }
}