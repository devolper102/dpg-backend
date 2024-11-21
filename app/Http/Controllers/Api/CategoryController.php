<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Website;
use App\Models\PlanDetailData;
use App\Models\PlanDetail;
use App\Models\PlanDetailPrice;
use App\Models\Plan;


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
}
