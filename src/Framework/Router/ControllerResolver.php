<?php

namespace App\Framework\Router;

use App\Framework\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerResolver
{
    private $routes;

    public function __construct()
    {
        $this->routes = Router::load();
    }

    public static function getResponse(Request $request)
    {
        return (new self())->resolveController($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function resolveController(Request $request)
    {
        /** @var Route $route */
        $route = $this->routes->match($request->getPath(), $request->getMethod());
        // parse route params and call controllers with the params
        list($controller, $action) = $this->getControllerAction($route);

        return call_user_func_array(
            [new $controller($request), $action],
            $route->extractParams($request->getPath())
        );
    }

    private function getControllerAction(Route $route)
    {
        $parts = explode(Router::CONTROLLER_ACTION_SEPARATOR, $route->getController());
        return [
            sprintf('App\\Controllers\\%s', $parts[0]),
            $parts[1]
        ];
    }
}