<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
    public $timestamps = true;

    protected $table = 'agreements_config';
}
