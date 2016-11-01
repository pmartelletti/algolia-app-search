<?php
use App\Framework\Utils\Validator;
use App\Framework\Exception\ValidationException;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_check_a_field_is_required()
    {
        $validator = new Validator('test', 'this is my test data' , 'required');
        $this->assertTrue($validator->validate());
        // check that is failing on null
        $validator = new Validator('test2', null, 'required');
        $this->expectException(ValidationException::class);
        $validator->validate();
    }

    /**
     * @test
     */
    public function it_should_check_a_field_is_an_url()
    {
        $validator = new Validator('url', 'http://google.com.ar' , 'required|url');
        $this->assertTrue($validator->validate());

        $validator = new Validator('test2', 'google', 'required|url');
        $this->expectException(ValidationException::class);
        $validator->validate();
    }
}
