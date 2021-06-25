<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public function posts(): HasMany
    {
        return $this->hasMany('App\Models\Post');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
}
