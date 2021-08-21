<?php
    require 'bootstrap.php';
    use www\classes\Movie;


    function home(){
        return '
        <div style="text-align: center; margin: 40% 0px 0px 0px">
            <h1>PHP API</h1>
        </div>';
    }


    function handle(){
        return 'Hello';
    }

    function getMovie(){
        $movie = new Movie();
        return $movie->getMoviesDataFromCache(false);
    }

    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '/', home());
        $r->addRoute('GET', '/users', handle());
        $r->addRoute('GET', '/movie', getMovie());
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
            // echo 'FOUND!';
            echo $handler;
            break;
    }
?>