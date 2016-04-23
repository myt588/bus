<?php

namespace App\Providers;

use App\Permission;
use App\Role;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //Dynamically register permissions with Laravel's Gate.
        // foreach ($this->getPermissions() as $permission) {
        //     $gate->define($permission->name, function ($user) use ($permission) {
        //         return $user->hasPermission($permission);
        //     });
        // }

        // foreach ($this->getRoles() as $role) {
        //     $gate->define($role->name, function ($user) use ($role) {
        //         return $user->hasRole($role);
        //     });
        // }
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }

    /**
     * Fetch the collection of site roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getRoles()
    {
        return Role::all();
    }
}
