<?php

namespace App\Livewire\User;

use App\Services\UserService;
use Livewire\Component;

class UserList extends Component
{
    public function users()
    {
        $service = new UserService();

        return $service->getAll();
    }
}
