<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use SensitiveParameter;

class Login extends BaseLogin
{
    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        return [
            ...parent::getCredentialsFromFormData($data),
            'is_dismissed' => false,
        ];
    }
}