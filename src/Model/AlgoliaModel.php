<?php

namespace App\Model;


use AlgoliaSearch\Client;

abstract class AlgoliaModel
{
    protected $algolia;

    public function __construct()
    {
        $this->algolia = new Client(getenv('ALGOLIA_APP_ID'), getenv('ALGOLIA_API_KEY'));
    }

    public abstract function getIndexName();

    /**
     * @return \AlgoliaSearch\Index
     */
    protected function getIndex()
    {
        return $this->algolia->initIndex($this->getIndexName());
    }

    public abstract function addToAlgolia();
}