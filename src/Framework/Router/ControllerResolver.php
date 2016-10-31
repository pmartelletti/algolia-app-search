<?php

namespace App\Framework\Router;

use App\Framework\Http\Request;

class ControllerResolver
{
    private $routes;

    public function __construct(Router $router)
    {
        $this->routes = $router;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function resolveController(Request $request)
    {
        /** @var Route $route */
        $route = $this->routes->match($request->getPath(), $request->getMethod());
        // parse route params and call controllers with the params
        list($controller, $action) = $this->getControllerAction($route);

        $response = call_user_func_array(
            [new $controller($request), $action],
            $route->extractParams($request->getPath())
        );
        if($response === false) {
            throw new \Exception('routing.yml error: the defined controller / action does not exists');
        }

        return $response;
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