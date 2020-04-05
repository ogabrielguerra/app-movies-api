<?php

namespace App\Http\Controllers;

class AppController
{
    private $numPages = 11;

    public function home()
    {
        echo 'API';
    }

    public function error404()
    {

        $output = [
            "status" => "error",
            "error_code" => "404"
        ];

        header('Content-Type: application/json');
        return json_encode($output);
    }

    public function getNumPages()
    {
        return $this->numPages;
    }
}
