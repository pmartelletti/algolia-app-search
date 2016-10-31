<?php
namespace App\Framework\Router;

use App\Framework\Exception\Http404NotFoundException;
use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class Router
{
    const CONTROLLER_ACTION_SEPARATOR = '::';
    /** @var  Collection */
    private $routes;

    public function __construct($routes = '')
    {
        $this->loadRoutes($routes);
    }

    protected function loadRoutes($file)
    {
        $this->routes = collect(Yaml::parse(file_get_contents($file)));
        return $this;
    }


    public function match($path, $method)
    {
        /** @var Route $route */
        return $this->routes->map(function($value, $key){
            return new Route($value['path'], $value['method'], $value['controller']);
        })->first(function(Route $route, $key) use($path, $method){
            return preg_match($route->getRegex(), $path, $matches) && $route->getMethod() === $method;
        }, function (){
            // no route match the request
            throw new Http404NotFoundException();
        });
    }
}
