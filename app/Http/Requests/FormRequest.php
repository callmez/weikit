<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationHttpException;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class FormRequest extends BaseFormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new ValidationHttpException($validator->errors());
        }

        parent::failedValidation($validator);
    }
}
