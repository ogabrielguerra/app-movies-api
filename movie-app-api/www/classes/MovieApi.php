<?php
namespace www\classes;

class MovieApi
{
    private $data = [];
    private $numPages = 11;

    public function handleCache($url, $file){
        $limit = $this->numPages + 1;

        for($i=1; $i<$limit; $i++){
//            $url = 'https://api.themoviedb.org/3/movie/upcoming?api_key=1f54bd990f1cdfb230adb312546d765d&page='.$i;
            $json = json_decode(file_get_contents($url));

            foreach ($json->results as $movie){
                array_push($this->data, $movie);
            }
        }

        try{
            $writeCache = fopen('../cache/movies.json', 'w');
            fwrite($writeCache, json_encode($this->data));
            fclose($writeCache);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}