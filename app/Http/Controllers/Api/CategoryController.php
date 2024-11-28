<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Website;
use App\Models\PlanDetailData;
use App\Models\PlanDetail;
use App\Models\PlanDetailPrice;
use App\Models\Booking;
use App\Models\Plan;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
            $websiteName = $request->input('website_name');
            $websiteId = Website::where('name', $websiteName)->pluck('id')->first();
            // dd($website);
            $categories = Category::where('website_id', $websiteId)->get();
            $plans = Plan::where('website_id', $websiteId)->where('status', 1)->get();
            $planDetailPrices = PlanDetailPrice::with('planDetail')->get();
            // dd($planDetails);
                return response()->json([
                    "categories" => $categories,
                    "planDetailPrices" => $planDetailPrices,
                    "plans" => $plans,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    public function getCategoriesHome(Request $request)
    {
            $websiteName = $request->input('website_name');
            $websiteId = Website::where('name', $websiteName)->pluck('id')->first();
            // dd($website);
            $categories = Category::where('website_id', $websiteId)->get();
                return response()->json([
                    "categories" => $categories,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    public function getServices(Request $request)
    {
            $id = $request->input('id');
            // dd($id);
            $SelectedPlanDetailPrices = PlanDetailPrice::where('id', $id)->first();
            // dd($planDetailPrices);
            $planDetailData = PlanDetailData::where('plan_detail_id', $SelectedPlanDetailPrices->plan_detail_id)->get();
                return response()->json([
                    "planDetailData" => $planDetailData,
                    "SelectedPlanDetailPrices" => $SelectedPlanDetailPrices,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    public function saveAppointment(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'duration_from' => 'required|string',
        'appointment_date' => 'required|date',
        'cart' => 'required|array',
        // 'cart.*.id' => 'required|integer',
        // 'cart.*.price' => 'required|numeric',
        // 'cart.*.count' => 'required|integer',
        // 'cart.*.duration' => 'required|integer', // duration of each item in minutes
    ]);

    // Convert the duration_from to Carbon instance for easy manipulation
    $startTime = Carbon::parse($request->input('appointment_date') . ' ' . $request->input('duration_from'));

    // Initialize variables for total price, plan_detail_prices_ids, and total duration
    $totalPrice = 0;
    $planDetailPricesIds = [];
    $totalDuration = 0; // To accumulate the total duration in minutes
    $itemCounts = []; // Store count of each item (if you want to track item counts)

    // Loop through the cart items
    foreach ($request->input('cart') as $item) {
        // Multiply price by count to get total price for this item
        $itemPrice = $item['price'] * $item['count'];
        $totalPrice += $itemPrice;

        // Collect plan_detail_ids for reference
        $planDetailPricesIds[] = $item['id'];

        // Store item counts (optional, you can save this as a JSON or use individual columns in DB)
        $itemCounts[] = [
            'id' => $item['id'],
            'count' => $item['count']
        ];

        // Add the item's duration * count to the total duration (in minutes)
        $totalDuration += $item['duration'] * $item['count']; // duration of each item * count
    }

    // Calculate the end time by adding the total duration (in minutes) to the start time
    $endTime = $startTime->addMinutes($totalDuration); // Add total minutes to the start time

    // Format the end time to store only time (e.g., 04:15 PM)
    $formattedEndTime = $endTime->format('h:i A'); // This formats it as '04:15 PM'

    // Log the final end time for debugging purposes
    Log::debug('End Time:', ['end_time' => $formattedEndTime]);

    // Prepare the appointment data
    $appointmentData = [
        'duration_from' => $request->input('duration_from'),
        'appointment_date' => $request->input('appointment_date'), // Store as date (without time)
        'duration_to' => $formattedEndTime, // Store only the time in the format 'h:i A'
        'price' => $totalPrice, // Store the total price
        'plan_detail_prices_ids' => json_encode($planDetailPricesIds), // Store plan_detail_ids as JSON
        'item_counts' => json_encode($itemCounts), // Store item counts (you can store this as JSON)
    ];

    // Save the appointment in the database (example with Booking model)
    $booking = Booking::create($appointmentData);

    // If needed, return the response (e.g., success or failure message)
    return response()->json([
        'status' => 'success',
        'message' => 'Appointment saved successfully!',
        'booking' => $booking
    ]);
}
    public function getPlansForServices(Request $request)
    {
            $category = $request->input('category');
            $categoryId = Category::where('name', $category)->pluck('id')->first();
            // dd($id);
            $plans = PlanDetail::where('category_id', $categoryId)->with('planDetailPrices', 'plan')->get();
                return response()->json([
                    "plans" => $plans,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
}
