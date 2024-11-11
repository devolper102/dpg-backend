<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = [
        'company_id',
        'website_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'skill',
        'image',
        'available_from',
        'available_to',
        'address',
        'status',
    ];
    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}