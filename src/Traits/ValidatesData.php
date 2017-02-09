<?php

namespace Nord\Lumen\Core\Traits;

use Closure;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;

trait ValidatesData
{
    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     *
     * @return Validator
     */
    private function createValidator(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        return $this->getValidatorFactory()->make($data, $rules, $messages, $customAttributes);
    }

    /**
     * @param array   $data
     * @param array   $rules
     * @param Closure $validationFailed
     * @param array   $messages
     * @param array   $customAttributes
     *
     * @return array
     */
    private function tryValidateData(
        array $data,
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
