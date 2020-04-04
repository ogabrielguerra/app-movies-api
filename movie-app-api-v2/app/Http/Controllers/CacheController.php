<?php

namespace App\Http\Controllers;

class CacheController extends AppController
{

    private $data = [];
    private $cachePath = '../cache/';

    private function writeCache($url, $cacheFile): bool
    {

        $limit = $this->getNumPages();

        for ($i = 1; $i < $limit; $i++) {
            // Each iteration will increment the number of items passing $i index as parameter to the URL
            $json = json_decode(file_get_contents($url . $i));

            foreach ($json->results as $movie) {
                array_push($this->data, $movie);
            }
        }

        try {
            $writeCache = fopen($this->cachePath . $cacheFile, 'w');
            fwrite($writeCache, json_encode($this->data));
            fclose($writeCache);
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function getDataFromCache($rebuildCache = false, $url, $cacheFile): String
    {

        $fullFilePath = $this->cachePath . $cacheFile;

        if ($rebuildCache || !file_exists($fullFilePath)) {
            try {
                $this->writeCache($url, $cacheFile);
            } catch (Exception $e) {
                return null;
            }
        }

        return file_get_contents($fullFilePath);
    }
}
