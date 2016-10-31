<?php
namespace App\Framework;

use App\Framework\Exception\Http404NotFoundException;
use App\Framework\Exception\ValidationException;
use App\Framework\Router\ControllerResolver;
use App\Framework\Http\Request;
use App\Framework\Http\Response;

class Application
{
    protected $controllerResolver;

    public function __construct(ControllerResolver $controllerResolver)
    {
        $this->controllerResolver = $controllerResolver;
    }

    public function handle(Request $request)
    {
        try {
            $this->controllerResolver->resolveController($request)->send();
        } catch (Http404NotFoundException $exception) {
            (new Response('Page not found', 404))->send();
        } catch (ValidationException $e){
            (new Response($e->getMessage(), 400))->send();
        } catch (\Exception $e) {
            (new Response($e->getMessage(), 500))->send();
        }
    }
}