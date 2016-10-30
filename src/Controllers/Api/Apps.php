<?php
namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Model\App;
use App\Framework\Http\Response;

class Apps extends Controller
{
    public function add()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required|url',
            'link' => 'required|url',
            'category' => 'required'
        ]);
        $app = App::create($this->request->getData())->addToAlgolia();

        return new Response($app->getAlgoliaId(), 201);
    }

    public function delete($id)
    {
        App::create(collect(['algolia_id' => $id]))
            ->removeFromAlgolia();

        return new Response('', 200);
    }
}