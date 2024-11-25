<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('website_id')->nullable();
            $table->string('plan_detail_prices_ids')->nullable();
            $table->string('item_counts')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_whatsapp')->nullable();
            $table->longText('customer_address')->nullable();
            $table->string('company_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('appointment_date')->nullable();
            $table->time('duration_from')->nullable();
            $table->time('duration_to')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->longText('note')->nullable();
            $table->longText('internal_note')->nullable();
            $table->text('about_customer')->nullable();
            $table->string('commission')->nullable();
            $table->string('status')->default('pending');
            $table->string('booking_from')->default('website');
            $table->string('pin_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};