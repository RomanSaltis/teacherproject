<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function projectGroups()
   {
       return $this->hasMany('App\Models\Group', 'project_id', 'id');
   }
}
