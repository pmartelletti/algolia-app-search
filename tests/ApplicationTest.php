<?php

use App\Framework\Router\Router;
use App\Framework\Exception\Http404NotFoundException;
use App\Framework\Application;
use App\Framework\Http\Request;
use App\Framework\Exception\ValidationException;
use App\Framework\Router\ControllerResolver;

class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_handle_404_errors()
    {
        $router = $this->createMock(Router::class);
        $router
            ->expects($this->once())
            ->method('match')
            ->willThrowException(new Http404NotFoundException())
        ;
        $request = $this->createMock(Request::class);
        $app = new Application(new ControllerResolver($router));
        $reponse = $app->handle($request);
        $this->assertEquals(404, $reponse->getStatusCode());
    }

    /**
     * @test
     */
    public function it_should_handle_validation_errors()
    {
        $router = $this->createMock(Router::class);
        $router
            ->expects($this->once())
            ->method('match')
            ->willThrowException(new ValidationException())
        ;
        $request = $this->createMock(Request::class);
        $app = new Application(new ControllerResolver($router));
        $reponse = $app->handle($request);
        $this->assertEquals(400, $reponse->getStatusCode());
    }

    /**
     * @test
     */
    public function it_should_handle_generic_errors()
    {
        $router = $this->createMock(Router::class);
        $router
            ->expects($this->once())
            ->method('match')
            ->willThrowException(new Exception())
        ;
        $request = $this->createMock(Request::class);
        $app = new Application(new ControllerResolver($router));
        $reponse = $app->handle($request);
        $this->assertEquals(500, $reponse->getStatusCode());
    }
}