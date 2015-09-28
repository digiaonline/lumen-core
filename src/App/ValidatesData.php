<?php namespace Nord\Lumen\Core\App;

use Closure;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\Validator;

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
        $validator = $this->createValidator($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            call_user_func($validationFailed, $validator->errors()->getMessages());
        }
    }


    /**
     * @return Factory
     */
    private function getValidatorFactory()
    {
        return app('validator');
    }
}
