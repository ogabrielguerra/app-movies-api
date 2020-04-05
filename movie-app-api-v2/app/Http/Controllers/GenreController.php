<?php

namespace App\Http\Controllers;

class GenreController
{

    private $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=1f54bd990f1cdfb230adb312546d765d';
    private $cacheFile = 'genres.json';

    public function getGenresDataFromCache($rebuildCache = false)
    {
        $cache = new CacheController();
        return json_decode($cache->getDataFromCache($rebuildCache, $this->url, $this->cacheFile));
    }

    public function showAll()
    {
        $output = $this->getGenresDataFromCache();
        return $output;
    }


    function getGenresNamesByIds(String $ids)
    {
        $genres = $this->getGenresDataFromCache();
        $genres = $genres[0]->genres;
        $ids = explode(',', $ids);
        $movieGenres = [];

        foreach ($genres as $genre) {
            if (in_array($genre->id, $ids)) {
                array_push($movieGenres, $genre->name);
            }
        }

        return json_encode($movieGenres);

    }

}
