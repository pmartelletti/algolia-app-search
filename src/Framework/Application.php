<?php
namespace App\Framework;

use App\Framework\Exception\Http404NotFoundException;
use App\Framework\Exception\ValidationException;
use App\Framework\Router\ControllerResolver;
use App\Framework\Http\Request;
use App\Framework\Http\Response;

class Application
{
    protected $request;
    protected $routes;

    public function __construct()
    {
        $this->request = Request::create();
    }

    public static function run()
    {
        (new Application())->process();
    }

    public function process()
    {
        try {
            ControllerResolver::getResponse($this->request)->send();
        } catch (Http404NotFoundException $exception) {
            (new Response('Page not found', 404))->send();
        } catch (ValidationException $e){
            (new Response($e->getMessage(), 400))->send();
        } catch (\Exception $e) {
            (new Response($e->getMessage(), 500))->send();
        }
    }
}