<?php

namespace App\Http\Controllers;

class AppController
{
    private $numPages = 11;

    public function home()
    {
        echo 'API';
    }

    public function getNumPages()
    {
        return $this->numPages;
    }
}
