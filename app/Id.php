<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Id extends Model
{
    use HasFactory;

    protected $table = 'id';
    public $fillable = ['name', 'number', 'status' , 'local'];
}
