<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Table;
use App\Policies\TablePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Table::class => TablePolicy::class,
        \App\Models\KanbanComment::class => \App\Policies\KanbanCommentPolicy::class,

    ];
    
    public function boot()
    {
        $this->registerPolicies();
    }
}
