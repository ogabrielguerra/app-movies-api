<?php
    require 'bootstrap.php';
    use www\classes\CorsHandler;
    use www\classes\Movie;
    use www\classes\Poster;
    use www\classes\Genre;
    use www\classes\CacheBuilder;   

    $corsHandler = new CorsHandler($_SERVER);

    function home(){
        return '
        <div style="text-align: center; margin: 40% 0px 0px 0px">
            <h1>PHP API</h1>
        </div>';
    }


    function getPoster(){
        $movie = new Movie();
        $poster = new Poster($movie);
        var_dump($_GET);
        if(isset($_GET["imgRef"]) && !empty($_GET["imgRef"])){
            $ref = $_GET["imgRef"];
            return $poster->getPoster($ref);
        }else{
            return "Error: parameter missing";
        }
    }

    function getGenres(){
        $genre = new Genre();

        if(isset($_GET["idsList"]) && !empty($_GET["idsList"])){
            return 'faa';
            // $ids = $_GET["idsList"];
            // $idsList = explode(",", $idsList);
            // return $idsList;
            // echo $genre->getGenresNamesByIds($ar);
        }
        // return 'foo';
    }

    function getMovie(){
        $movie = new Movie();
        $content = $movie->getMoviesDataFromCache(false);
        if(!empty($content))
            return $content;
        return http_response_code(201);
    }

    function getMovieGenres(){
        $genre = new Genre();

        if(isset($_GET["ids"]) && !empty($_GET["ids"])){
            $ids = $_GET["ids"];
            $ar = explode(",", $ids);
            return [];
            // echo $genre->getGenresNamesByIds($ar);
        }
        return 'foo2';
    }

    function buildCache(){
        // $movie = new Movie();
        // $poster = new Poster($movie);
        // $genre = new Genre();
        // $cache = new CacheBuilder($movie, $poster, $genre);
        return 'Cache generated';
    }

    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '/', home());
        $r->addRoute('GET', '/poster', getPoster());
        $r->addRoute('GET', '/movie', getMovie());
        $r->addRoute('GET', '/movie/genres', getMovieGenres());
        $r->addRoute('GET', '/genre/{idsList:\d+}', getGenres());
        $r->addRoute('GET', '/build-cache', buildCache());

    });

    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];


    if (false !== $pos = strpos($uri, '?')) { 
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            break;
        
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            break;

        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            echo 'FOUND!';
            echo $handler;
            break;
    }
?>