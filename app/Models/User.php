<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $table = 'tbluser';
    protected $primaryKey = 'id';
    protected $hidden = ['password',];
    public $timestamps = false;
    protected $fillable = [
        'username', 
        'password',
        'gender',
        'jobid'
    ];
}