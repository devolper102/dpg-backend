<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetailData extends Model
{
    use HasFactory;
    protected $table = 'plan_detail_data';
    protected $fillable = [
        'plan_detail_id',
        'name',
        'image',
        'description',
        'status',
    ];
    public function planDetail(){
        return $this->belongsTo(PlanDetail::class, 'plan_detail_id');
    }
}