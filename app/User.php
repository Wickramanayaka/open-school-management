<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','teacher_id','status','activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class)->withDefault();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function generateToken()
    {
        /**
         * Disabled updating api_token every login
         * only first login will create api_token
         */
        if($this->api_token==null){
            $this->api_token = str_random(60);
            $this->save();
        }
        return $this->api_token;
    }
}
