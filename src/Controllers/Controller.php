<?php
namespace App\Controllers;

use App\Framework\Http\Request;
use App\Framework\Http\Response;
use App\Framework\Utils\Validator;

class Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function validate(array $rules)
    {
        // validate required fields for now
        collect($rules)->each(function($rule, $key){
            (new Validator($key, $this->request->get($key), $rule))->validate();
        });

    }

    /**
     * @param $template
     * @return Response
     */
    public function renderTemplate($template)
    {
        $templateContent = '';

        return new Response($templateContent, 200);
    }
}