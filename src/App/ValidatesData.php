<?php namespace Nord\Lumen\Core\App;

use Closure;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;

trait ValidatesData
{

    /**
     * @param mixed $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     *
     * @return Validator
     */
    private function createValidator($data, array $rules, array $messages = [], array $customAttributes = [])
    {
        return $this->getValidatorFactory()->make($data, $rules, $messages, $customAttributes);
    }


    /**
     * @param mixed $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     *
     * @return array
     */
    private function validateData($data, array $rules, array $messages = [], array $customAttributes = [])
    {
        return $this->createValidator($data, $rules, $messages, $customAttributes)->failed();
    }


    /**
     * @param mixed   $data
     * @param array   $rules
     * @param Closure $validationFailed
     * @param array   $messages
     * @param array   $customAttributes
     *
     * @return array
     */
    private function tryValidateData(
        $data,
        array $rules,
        Closure $validationFailed,
        array $messages = [],
        array $customAttributes = []
    ) {
        if (($errors = $this->validateData($data, $rules, $messages, $customAttributes))) {
            call_user_func($validationFailed, $errors);
        }

        return $errors;
    }


    /**
     * @return Factory
     */
    private function getValidatorFactory()
    {
        return app('validator');
    }
}
