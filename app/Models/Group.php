<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public function groupProject()
   {
       return $this->belongsTo('App\Models\Project', 'project_id', 'id');
   }
   public function groupStudents()
   {
       return $this->hasMany('App\Models\Student', 'group_id', 'id');
   }

}
