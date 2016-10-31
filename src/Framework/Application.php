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

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        try {
            $response = $this->controllerResolver->createResponse($request);
        } catch (Http404NotFoundException $exception) {
            $response = new Response('Page not found', 404);
        } catch (ValidationException $e){
            $response = new Response($e->getMessage(), 400);
        } catch (\Exception $e) {
            $response = new Response($e->getMessage(), 500);
        }

        return $response;
    }
}