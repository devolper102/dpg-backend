<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;
    protected $table = 'plan_details';
    protected $fillable = [
        'website_id',
        'category_id',
        'plan_id',
        'subscription_id',
        'status',
    ];
    public function website(){
        return $this->belongsTo(Website::class, 'website_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
    public function planDetailDatas(){
        return $this->hasMany(PlanDetailData::class, 'plan_detail_id');
    }
    public function planDetailPrices(){
        return $this->hasMany(PlanDetailPrice::class, 'plan_detail_id');
    }


}