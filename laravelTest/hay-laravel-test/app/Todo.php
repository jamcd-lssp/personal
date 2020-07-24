<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    public function tasks()
    {
        return $this->hasMany('App\Task', 'folder_id', 'id');
    }
}
