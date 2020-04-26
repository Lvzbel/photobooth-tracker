<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function scopeGetUserRole($query, $user_id)
    {   
        // Find user by id
        $user = $query->find($user_id);
        // Return role as a string
        return $user->roles->first()->name;
    }

    public function scopeUsersInfo($query)
    {
        // Gets all users
        $users = $query->get();
        // Attaches role to every user
        foreach($users as $user) {
            $role = $user->roles->first();
            $roleName = $role ? $role->name : null;
            $user->role = $roleName;
        }
        return $users;
    }

    public function scopeGrantRole($query, $user_id, $role)
    {
        // Requires user_id and role: 'admin', 'manager' or 'photographer'
        
        // Find User with ID
        $user = $query->find($user_id);
        // Grant user the role
        $user->attachRole($role);
        // Return True is user has been granted succesfully
        return $user->hasRole($role);
    }

    public function scopeStripRole($query, $user_id)
    {
        // Takes user id and strips the current granted role
        
        // Find User with ID
        $user = $query->find($user_id);
        // Get the User's Role
        $user_current_role = $user->roles->first();
        // Detach Role
        $user->detachRole($user_current_role);
        // Return's true if user doesn't have role
        return !$user->hasRole($user_current_role);
    }
}