<?php

namespace App\Models;

class User
{
    private $firstName;
    private $lastName;
    private $email;

    public function firstName(string $firstName = null): string
    {
        if (isset($firstName)) {
            $this->firstName = trim($firstName);
        }

        return $this->firstName;
    }

    public function lastName(string $lastName = null): string
    {
        if (isset($lastName)) {
            $this->lastName = trim($lastName);
        }

        return $this->lastName;
    }
    
    public function fullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function email(string $email = null): string
    {
        if (isset($email)) {
            $this->email = trim($email);
        }

        return $this->email;
    }

    public function emailVariables(): array
    {
        return [
            'fullname' => $this->fullname(),
            'email' => $this->email()
        ];
    }
}
