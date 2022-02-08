<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
