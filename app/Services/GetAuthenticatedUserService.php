<?php

namespace App\Services;

use App\DTOs\AuthenticatedUser;
use App\Exceptions\InvalidTokenException;
use App\Models\User;

class GetAuthenticatedUserService
{
    public function execute(AuthenticatedUser $authenticatedUser): User
    {
        $user = auth('api')
            ->setToken($authenticatedUser->token)
            ->user();

        if (! $user) {
            throw new InvalidTokenException();
        }

        return $user;
    }
}
