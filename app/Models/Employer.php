<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Employer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'slug',
        'company_email',
        'company_address'
    ];

    /**
     * Set the employers's company_name.
     *
     * @param  string  $value
     * @return void
     */
    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-'); // Fix the bug for unique state!
    }

    /**
     * Employer relations.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
