<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function getServices(){
        try {
            $servies = Plan::all();
            if (!$servies) {
                return response()->json([
                    'status' => 'false',
                    'message' => 'Data not found',
                    'body' => null,
                ], 404);
            }
            return response()->json([
                'status' => 'true',
                'message' => 'Services fetched successfully',
                'body' => $servies,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving the user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}