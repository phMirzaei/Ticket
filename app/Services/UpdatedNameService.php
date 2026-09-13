<?php

namespace App\Services;

use App\DTOs\UpdatedName;
use App\Exceptions\InvalidTokenException;

class UpdatedNameService
{
    public function execute(UpdatedName $updatedName): void
    {
        $user = auth('api')
            ->setToken($updatedName->token)
            ->user();

        if (!$user) {
            throw new InvalidTokenException();
        }

        $user->update([
            'name' => $updatedName->name,
        ]);

    }
}
