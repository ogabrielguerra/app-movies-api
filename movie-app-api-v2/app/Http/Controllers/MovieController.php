<?php

namespace App\Http\Controllers;

class MovieController
{
    private $data = [];
    private $numPages = 11;
    private $url = 'https://api.themoviedb.org/3/movie/upcoming?api_key=1f54bd990f1cdfb230adb312546d765d&page=';
    private $cacheFile = 'movies.json';

    public function getMoviesDataFromCache($rebuildCache = false)
    {
        $cache = new CacheController($multiPage = true);
        return json_decode($cache->getDataFromCache($rebuildCache, $this->url, $this->cacheFile, $multiPage = false));
    }

    private function getMovie($id = null)
    {
        if ($id != null) {

            $data = $this->getMoviesDataFromCache();

            foreach ($data as $movie) {
                if ($id == $movie->id) {
                    return $movie;
                }
            }
            return null;
        }
    }

    public function showAll()
    {
        $output = $this->getMoviesDataFromCache();
        return $output;
    }

    public function showMovie($id)
    {
        $output = json_encode($this->getMovie($id));
        return $output;
    }
}
