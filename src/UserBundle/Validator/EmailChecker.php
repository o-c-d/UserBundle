<?php

namespace Ocd\UserBundle\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class EmailChecker
{
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($email)
    {
        $emailConstraint = new Assert\Email();
        $emailConstraint->message = 'Invalid email address';
        $errors = $this->validator->validateValue(
            $email,
            $emailConstraint 
        );

    }
}