<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = true;

    protected $table = 'roles';
}
