<?php

namespace Application\Core\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = ['name'];



}