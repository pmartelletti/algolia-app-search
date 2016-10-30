<?php
namespace App\Framework\Http;

class Response
{
    private $headers;
    private $content;
    private $statusCode;

    public function __construct($content = '', $status = 200, $headers = array())
    {
        $this->headers = collect($headers);
        $this->setContent($content);
        $this->setStatusCode($status);
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    public function sendHeaders()
    {
        // check if headers were sent
        if(headers_sent()) {
            return $this;
        }
        // send custom headers
        $this->headers->each(function($name, $value){
            header($name.': '.$value, false, $this->statusCode);
        });
        // HTTP status
        header(sprintf('HTTP/1.0 %s', $this->statusCode), true, $this->statusCode);

        return $this;
    }

    public function sendContent()
    {
        echo $this->content;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param \Illuminate\Support\Collection $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }
}
