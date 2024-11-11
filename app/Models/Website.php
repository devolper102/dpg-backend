<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table = 'websites';
    protected $fillable = [
        'name',
        'logo',
        'url',
        'contact',
        'open_time',
        'close_time',
        'description',
        'address',
        'status',
        'active',
    ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
     public function companies()
    {
        return $this->hasMany(Company::class);
    }
}