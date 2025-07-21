<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class DisobedienceCategoryRole extends Model
{
    protected $fillable = ['role_id', 'disobedience_category_id'];
}
