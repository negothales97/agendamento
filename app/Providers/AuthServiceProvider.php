<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // $permissions = Permission::with('roles')->get();
        // foreach ($permissions as $permission) {
        //     Gate::define($permission->name, function ($admin) use ($permission) {
        //         return $admin->hasPermission($permission);
        //     });
        // }
    }
}
