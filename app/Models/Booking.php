<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'website_id',
        'plan_id',
        'subscription_id',
        'category_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_whatsapp',
        'company_id',
        'employee_id',
        'service_id',
        'customer_address',
        'appointment_date',
        'duration_from',
        'duration_to',
        'price',
        'note',
        'internal_note',
        'about_customer',
        'commission',
        'status',
        'booking_from',
        'pin_location',
    ];
    public function website(){
        return $this->belongsTo(Website::class);
    }
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'employee_id');  // Relating employee_id to the Staff model
    }
}