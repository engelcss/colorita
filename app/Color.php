<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sort', 'color'];
}
