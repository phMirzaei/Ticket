<?php

namespace App\Services\Admin;

use App\DTOs\Admin\AddSupport;
use App\Models\User;

class AddSupportService
{
    public function execute(AddSupport $addSupport)
    {
        User::where('id', $addSupport->userId)->update([
            'role' => 'support',
        ]);
    }
}
