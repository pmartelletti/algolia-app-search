<?php
namespace App\Controllers;

use App\Framework\Http\Request;
use App\Framework\Http\Response;
use App\Framework\Utils\Validator;

class Controller
{
    protected $request;
    protected $twig;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem(base_dir('resources/views')));
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
    public function renderTemplate($template, array $params)
    {
        $templateContent = $this->twig->render(sprintf('%s.html.twig', $template), $params);

        return new Response($templateContent, 200);
    }
}