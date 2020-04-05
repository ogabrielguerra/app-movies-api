<?php

namespace App\Http\Controllers;

class CacheRunnerController
{
    public function buildCache(): string
    {

        try {

            $this->clearCache();

            $movie = new MovieController();
            $movie->getMoviesDataFromCache(true);

            $genre = new GenreController();
            $genre->getGenresDataFromCache(true);

            $poster = new PosterController($movie);
            $poster->writeCache();

            $output = [
                "status" => "cache_built"
            ];

        } catch (Exception $e) {

            $output = [
                "status" => "exception_raised",
                "exception" => $e
            ];

        }

        return json_encode($output);

    }

    private function clearFiles(string $path): void
    {
        $files = glob($path . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    private function clearCache(): void
    {

        // Clear Posters
        $postersPath = '../cache/posters/';
        $this->clearFiles($postersPath);

        if (is_dir($postersPath))
            rmdir($postersPath);

        // Clear jsons
        $jsonsPath = '../cache/';
        $this->clearFiles($jsonsPath);
    }

}
