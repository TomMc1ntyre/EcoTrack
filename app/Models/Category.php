<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'points', 'icon'];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
