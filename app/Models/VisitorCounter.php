<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorCounter extends Model
{
    protected $table = 'cntr';
    protected $primaryKey = 'cntr_hash';
    public $timestamps = false;
}
