<?php

namespace App\Framework\Router;

class Route
{
    const REGEX_DELIMITER = '#';
    const SEPARATOR = '/';
    const VARIABLE_PLACEHOLDER = ':';

    protected $method;
    protected $path;
    protected $controller;


    public function __construct($path, $method, $controller)
    {
        $this->path = $path;
        $this->method = $method;
        $this->controller = $controller;
    }

    /**
     * Get Regex from path attribute
     *
     * @return string
     */
    public function getRegex()
    {
        $parts = collect(explode(self::SEPARATOR, $this->getPath()));
        $regex = $parts->map(function($value){
            $characters = collect(str_split($value));
            // we only use word regex in this basic version
            return $characters->contains(self::VARIABLE_PLACEHOLDER) ?
                '(\w+)' : $value;
        })->implode(sprintf('\%s', self::SEPARATOR));

        return sprintf('/^%s$/', $regex);
    }

    public function extractParams($url)
    {
        preg_match($this->getRegex(), $url, $matches);
        array_shift($matches);
        return $matches;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
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
    public function getController()
    {
        return $this->controller;
    }
}