<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetailPrice extends Model
{
    use HasFactory;
    protected $table = 'plan_detail_prices';
    protected $fillable = [
        'plan_detail_id',
        'name',
        'image',
        'price',
        'sale_price',
        'unit',
        'duration',
        'status',
    ];
    public function planDetail(){
        return $this->belongsTo(PlanDetail::class, 'plan_detail_id');
    }

}