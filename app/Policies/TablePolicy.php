<?php

namespace App\Policies;

use App\Models\Table;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TablePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Table $table)
    {
        return $user->hasPermissionTo($table->name) || $user->hasRole('admin');
    }

    public function update(User $user, Table $table)
    {
        return $user->hasPermissionTo($table->name) || $user->hasRole('admin');
    }
}
