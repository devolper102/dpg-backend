<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'website_url',
        'website_id',
        'email',
        'phone',
        'logo',
        'type',
        'address',
        'status',
        'commission',
    ];
    public function staffs(){
        return $this->hasMany(Staff::class, 'company_id', 'id');
    }
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}