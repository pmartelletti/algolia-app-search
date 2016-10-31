<?php

use App\Framework\Router\Router;
use App\Framework\Exception\Http404NotFoundException;
use App\Framework\Router\Route;

class RouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_parses_routes_files()
    {
        $router = $this->createRouter();
        $expectedRoutes = collect([
            'test.index' => ['path' => '/', 'method' => 'GET', 'controller' => 'Home::index'],
            'test.save' => ['path' => '/', 'method' => 'POST', 'controller' => 'Home::save'],
            'test.update' => ['path' => '/:id', 'method' => 'PUT', 'controller' => 'Home::update'],
            'test.delete' => ['path' => '/:id', 'method' => 'DELETE', 'controller' => 'Home::delete']
        ]);
        $this->assertEquals($expectedRoutes, $router->getRoutes());
    }

    /**
     * @test
     */
    public function it_should_match_url()
    {
        $router = $this->createRouter();
        $expectedRoute = new Route('/', 'GET', 'Home::index');
        $this->assertEquals($expectedRoute, $router->match('/', 'GET'));

        $expectedRoute = new Route('/:id', 'PUT', 'Home::update');
        $this->assertEquals($expectedRoute, $router->match('/2', 'PUT'));

        $expectedRoute = new Route('/:id', 'DELETE', 'Home::delete');
        $this->assertEquals($expectedRoute, $router->match('/2', 'DELETE'));
    }

    /**
     * @test
     */
    public function it_should_not_match_same_url_but_diff_method()
    {
        $router = $this->createRouter();
        $expectedRoute = new Route('/:id', 'DELETE', 'Home::delete');
        $this->assertNotEquals($expectedRoute, $router->match('/2', 'PUT'));
    }

    /**
     * @test
     */
    public function it_should_throw_404_exception()
    {
        $this->expectException(Http404NotFoundException::class);
        $this->createRouter()->match('/apps/2/edit', 'GET');
    }

    /**
     * @return Router
     */
    private function createRouter()
    {
        return new Router(__DIR__ . '/support-files/routes.yml');
    }
}