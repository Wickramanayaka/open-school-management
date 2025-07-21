<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use ProactiveAnts\Discipline\Disobedience;

class DisobedienceCategory extends Model
{
    protected $fillable = ['name', 'description', 'point_deduct', 'is_critical'];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'disobedience_category_roles');
    }

    public function disobediences()
    {
        return $this->hasMany(Disobedience::class);
    }

}
