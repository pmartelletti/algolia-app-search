<?php

use App\Framework\Router\ControllerResolver;
use App\Framework\Router\Router;
use App\Framework\Router\Route;
use App\Framework\Http\Response;
use App\Framework\Http\Request;

class ControllerResolverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_resolve_controller_from_route()
    {
        $expectedController = [
            'App\\Controllers\\Home', 'index'
        ];
        $route = new Route('/', 'GET', 'Home::index');
        $this->assertEquals($expectedController, $this->getControllerResolver()->getControllerAction($route));
    }

    private function getControllerResolver()
    {
        $router = new Router(__DIR__ . '/support-files/routes.yml');
        return new ControllerResolver($router);
    }
}