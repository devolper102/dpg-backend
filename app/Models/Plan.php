<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = [
        'website_id',
        'name',
        'description',
        'status',
    ];
    public function website(){
        return $this->belongsTo(Website::class);
    }
}