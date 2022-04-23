<?php
namespace www\classes;

class Movie implements iMovie{

    private $data = [];
    private $numPages = 11;
    private $moviesJsonFile = './cache/movies.json';
    private $url = 'https://api.themoviedb.org/3/movie/upcoming?api_key=1f54bd990f1cdfb230adb312546d765d&page=';

    private function writeCache(){

        $limit = $this->numPages + 1;

        for($i=1; $i<$limit; $i++){
            $url = $this->url.$i;
            $json = json_decode(file_get_contents($url));

            foreach ($json->results as $movie){
                array_push($this->data, $movie);
            }
        }
        
        try{
            $writeCache = fopen($this->moviesJsonFile, 'w');
            fwrite($writeCache, json_encode($this->data));
            fclose($writeCache);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function getMoviesDataFromCache(bool $rebuildCache=false): String{

        if($rebuildCache || !file_exists($this->moviesJsonFile)){
            $this->writeCache();
        }

        return file_get_contents($this->moviesJsonFile);
    }

    public function getMovie(int $id=null){
        if($id!=null){
            $data = json_decode($this->getMoviesDataFromCache());

            foreach ($data as $movie){
                if($id === $movie->id){
                    return $movie;
                }
            }
            return false;
        }
    }
}