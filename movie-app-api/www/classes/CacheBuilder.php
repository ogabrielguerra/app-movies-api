<?php
namespace www\classes;

class CacheBuilder{
    function __construct($movie, $poster, $genre)
    {
        $movie->writeCache();
        $poster->writeCache();
        $genre->writeCache();
        echo "Cache built succesfully!";
    }
}