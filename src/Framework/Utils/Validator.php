<?php
namespace App\Framework\Utils;

use App\Framework\Exception\ValidationException;

class Validator
{
    protected $parameterName;
    protected $rules;
    protected $data;

    public function __construct($parameterName, $data, $rules)
    {
        $this->parameterName = $parameterName;
        $this->data = $data;
        $this->rules = collect(explode("|", $rules));
    }

    public function validate()
    {
        $this->rules->each(function($rule){
            $method = sprintf('is%s', ucfirst($rule));
            if(!call_user_func([$this, $method])) {
                throw new ValidationException(
                    sprintf('Parameter "%s" fail the following validation: %s', $this->parameterName, $rule)
                );
            }
        });

        return true;
    }

    protected function isRequired()
    {
        return $this->data !== null;
    }

    protected function isUrl()
    {
        return filter_var($this->data, FILTER_VALIDATE_URL) !== false;
    }
}