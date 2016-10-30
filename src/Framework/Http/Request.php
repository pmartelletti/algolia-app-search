<?php
namespace App\Framework\Http;

class Request
{
    protected $method;
    protected $data;
    protected $path;
    protected $contentType;

    public function __construct($method, $path, $data, $contentType)
    {
        $this->method = $method;
        $this->path = $path;
        $this->contentType = $contentType;
        $this->data = collect($data);
    }

    public function get($key)
    {
        return $this->getData()->get($key, null);
    }

    /**
     * Creates a new request based on PHP's globals ($_REQUEST, $_SERVER)
     *
     * @return Request
     */
    public static function create()
    {
        return (new Request(
            $_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'],
            $_REQUEST, $_SERVER['CONTENT_TYPE']
        ))->processBody();
    }

    public function processBody()
    {
        $body = file_get_contents('php://input');
        switch ($this->getContentType()) {
            case "application/json":
                $this->data = $this->data->merge(collect(json_decode($body, true)));
                break;
            default:
                // TODO: add more content type parsers maybe?
        };

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}
