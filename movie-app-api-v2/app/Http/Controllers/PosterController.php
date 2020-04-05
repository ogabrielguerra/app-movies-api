<?php

namespace App\Http\Controllers;

use Mockery\Exception;

class PosterController
{

    private $movie;
    private $baseUrl = 'https://image.tmdb.org/t/p/w342/';
    private $posterPath = '../cache/posters/';

    function __construct(MovieController $movie)
    {
        $this->movie = $movie;
    }

    function writeCache()
    {
        $json = $this->movie->getMoviesDataFromCache(false);

        // Check if Poster's path exists
        if (!file_exists($this->posterPath)) {
            mkdir($this->posterPath);
        }

        foreach ($json as $movie) {
            // Get poster name/string
            $poster = substr($movie->poster_path, 1);

            // Get poster from original location
            $input = $this->baseUrl . $poster;
            $output = $this->posterPath . $poster;

            // Image don't exist yet
            if (!file_exists($output)) {
                try {
                    file_put_contents($output, file_get_contents($input));
                } catch (Exception $e) {

                }
            }
        }
    }

    function getPoster(String $imageRef)
    {
        $poster = 'https://gabrielguerra.me/movie-app-api/cache/posters/' . $imageRef;
        echo $poster;
    }

}
