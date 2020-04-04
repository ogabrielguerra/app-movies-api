<?php

namespace App\Http\Controllers;

class AppController
{
    private $numPages = 11;

    function __construct()
    {
    }

    function getNumPages()
    {
        return $this->numPages;
    }
}
