<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'cpf'   => 'required',
            'name'  => 'required', //|min:3
            'phone' => 'required',
            'email' => 'required|unique:users,email',   // obrigatório no campo 'email' da tabela 'users'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'cpf'   => 'required',
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users,email',
        ],
    ];
}
