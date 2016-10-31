<?php

namespace App\Controllers;

use App\Framework\Http\Response;

class Home extends Controller
{
    public function index()
    {
        return $this->renderTemplate('index', [
            'algolia_search_key' => getenv('ALGOLIA_SEARCH_KEY'),
            'algolia_app_id' => getenv('ALGOLIA_APP_ID'),
            'algolia_apps_index' => getenv('ALGOLIA_APPS_INDEX')
        ]);
    }

    public function instantSearch()
    {
        return $this->renderTemplate('instantsearch', [
            'algolia_search_key' => getenv('ALGOLIA_SEARCH_KEY'),
            'algolia_app_id' => getenv('ALGOLIA_APP_ID'),
            'algolia_apps_index' => getenv('ALGOLIA_APPS_INDEX')
        ]);
    }
}