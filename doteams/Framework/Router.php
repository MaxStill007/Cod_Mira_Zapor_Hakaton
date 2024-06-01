<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router{
    protected $routes = [];

    public function get($uri, $controller, $middleware = []){
        list($controllerName, $controllerMethod) = explode('@', $controller);
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'controllerName' => $controllerName,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }

    public function post($uri, $controller, $middleware = []){
        list($controllerName, $controllerMethod) = explode('@', $controller);
        $this->routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'controllerName' => $controllerName,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }

    public function put($uri, $controller, $middleware = []){
        list($controllerName, $controllerMethod) = explode('@', $controller);
        $this->routes[] = [
            'method' => 'PUT',
            'uri' => $uri,
            'controllerName' => $controllerName,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }

    public function delete($uri, $controller, $middleware = []){
        list($controllerName, $controllerMethod) = explode('@', $controller);
        $this->routes[] = [
            'method' => 'DELETE',
            'uri' => $uri,
            'controllerName' => $controllerName,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }


    public function route($uri){
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if($requestMethod === 'POST' && isset($_POST['_method'])){
            $requestMethod = strtoupper($_POST['_method']);  
        }
        foreach($this->routes as $route){
        $uriSegments = explode('/', trim($uri,'/'));
        $routeSegments = explode('/', trim($route['uri'],'/'));
            if(count($uriSegments) === count($routeSegments) && $route['method'] === $requestMethod){
                $params = [];
                $match = true;
                for($i = 0; $i < count($uriSegments); $i++){
                    if($uriSegments[$i] !== $routeSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])){
                        $match = false;
                        break;

                    }
                    if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)){
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                if($match){
                foreach($route['middleware'] as $userRole){
                    Authorize::handle($userRole);
                }
                $controller = 'App\\Controllers\\' . $route['controllerName'];
                $controllerMethod = $route['controllerMethod'];

                $controllerInit = new $controller();
                $controllerInit->$controllerMethod($params);
                return;
                }
            }
        }
        ErrorController::notFound();
    }
}