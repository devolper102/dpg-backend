<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'website_id',
        'name',
        'image',
        'slug',
        'description',
        'status',
    ];
    public function website(){
        return $this->belongsTo(Website::class);
    }
}