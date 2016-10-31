<?php

use App\Framework\Router\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_regex()
    {
        $route = new Route('/apps/:id', 'GET', 'AppController::show');
        $expectedRegex = '/^\/apps\/(\w+)$/';
        $this->assertEquals($expectedRegex, $route->getRegex());

        $route = new Route('/apps/:id/edit', 'GET', 'AppController::show');
        $expectedRegex = '/^\/apps\/(\w+)\/edit$/';
        $this->assertEquals($expectedRegex, $route->getRegex());
    }

    /**
     * @test
     */
    public function it_should_extract_single_params()
    {
        $route = new Route('/apps/:id', 'GET', 'AppController::show');
        $url = '/apps/1';
        $this->assertEquals([1], $route->extractParams($url));
        $this->assertNotEquals([2], $route->extractParams($url));
    }

    /**
     * @test
     */
    public function it_should_extract_multiple_params()
    {
        $route = new Route('/apps/:app/comments/:comment', 'GET', 'AppController::show');
        $url = '/apps/1/comments/3';
        $this->assertEquals([1, 3], $route->extractParams($url));
        $this->assertNotEquals([3, 1], $route->extractParams($url));
    }
}