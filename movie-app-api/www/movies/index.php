<?php
namespace www;
use www\classes\MovieApi;
use www\classes\Movie;
require '../bootstrap.php';

$movie = new Movie();
echo $movie->getMoviesDataFromCache(false);