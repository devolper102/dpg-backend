<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Company;
use App\Models\Website;
use App\Models\Category;
use App\Models\PlanDetail;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\PlanDetailData;
use App\Models\PlanDetailPrice;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    public function index(){
        return view('backend.dashboard');
    }
    // start Website functions
    public function changeWebsite($id){
        // Set all websites to inactive (0)
        Website::query()->update(['active' => '0']);
        // Activate the selected website
        $website = Website::find($id);
        $website->active = '1';
        $website->save(); // You can use save() instead of update()

        // Redirect with a status message
        return redirect()->back()->with('status', 'Website updated successfully');
    }
    public function getWebsite(){
        $websites = Website::all();
        return view('backend.website.index', compact('websites'));
    }
    public function addWebsite(){
        return view('backend.website.create');
    }
    public function storeWebsite(Request $request){

        $request->validate([
            'name' =>'required|unique:websites,name',
            'url' =>'required',
            'contact' =>'required',
            'logo' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            'description' =>'nullable|string',
            'address' =>'required|string',
        ]);
        $website= new Website();
        $website->name = $request->name;
        $website->url = $request->url;
        $website->contact = $request->contact;
        $website->open_time = $request->open_time;
        $website->close_time = $request->close_time;
        $website->description = $request->description;
        $website->address = $request->address;
        $website->status = '1';
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // Generate a unique name for the image
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            // Move the image to the public directory
            $logo->move(public_path('images/websites'), $logoName);
            // Save the image path to the shop model
            $website->logo = 'images/websites/' . $logoName;
        }
        $website->save();
        return redirect()->back()->with('status', 'Website added successfully');
    }
    public function editWebsite($id){
        $website = Website::where('id', $id)->first();
        return view('backend.website.edit', compact('website'));
    }
    public function updateWebsite(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'name' => [
                'required',
                Rule::unique('websites', 'name')->ignore($id), // Use $id
            ],
            'url' => 'required',
            'contact' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
        ]);

        // Find the website by ID
        $website = Website::find($id); // Use $id to find the correct website

        // Update the website fields
        $website->name = $request->name;
        $website->url = $request->url;
        $website->contact = $request->contact;
        $website->open_time = $request->open_time;
        $website->close_time = $request->close_time;
        $website->description = $request->description;
        $website->address = $request->address;
        $website->status = $request->status;

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            // Check and delete the old logo file if it exists
            if ($website->logo && file_exists(public_path($website->logo))) {
                unlink(public_path($website->logo)); // Delete the old logo file
            }
            // Handle the new logo upload
            $logo = $request->file('logo');
            // Generate a unique name for the image
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            // Move the image to the public directory
            $logo->move(public_path('images/websites'), $logoName);
            // Save the new image path to the website model
            $website->logo = 'images/websites/' . $logoName;
        }
        $website->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Website updated successfully');
    }
    public function deleteWebsite($id){
        $website = Website::where('id', $id)->first();
        if ($website->logo && file_exists(public_path($website->logo))) {
            unlink(public_path($website->logo)); // Delete the old logo file
        }
        $website->delete();
        return redirect()->back()->with('status', 'Website updated successfully');
    }
    // end Website functions
    // start Category functions
    public function getCategory(){
        $website = Website::where('active','1')->first();
        $categories = Category::where('website_id', $website->id)->with('website')->get();
        return view('backend.category.index', compact('categories'));
    }
    public function addCategory(){
        return view('backend.category.create');
    }
    public function storeCategory(Request $request){

        $request->validate([
            'name' =>'required|string',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' =>'nullable|string',
        ]);
        $website = Website::where('active','1')->first();
        $category= new Category();
        $category->name = $request->name;
        $category->website_id = $website->id;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name);
        $category->status = '1';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/categories'), $imageName);
            // Save the image path to the shop model
            $category->image = 'images/categories/' . $imageName;
        }
        $category->save();
        return redirect()->back()->with('status', 'Category added successfully');
    }
    public function editCategory($id){
        $websites = Website::all();
        $category = Category::where('id', $id)->first();
        return view('backend.category.edit', compact('category','websites'));
    }
    public function updateCategory(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'name' =>'required|string',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'description' =>'nullable|string',
        ]);
        $website = Website::where('active','1')->first();
        // Find the website by ID
        $category = Category::find($id); // Use $id to find the correct website

        // Update the website fields
        $category->name = $request->name;
        $category->website_id = $website->id;
        $category->description = $request->description;
        if($category->name){
            $category->slug = Str::slug($request->name);
        }
        $category->status = $request->status;
        // Handle logo file upload
        if ($request->hasFile('image')) {
            // Check and delete the old logo file if it exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image)); // Delete the old logo file
            }
            // Handle the new logo upload
            $image = $request->file('image');
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/categories'), $imageName);
            // Save the new image path to the website model
            $category->image = 'images/categories/' . $imageName;
        }
        $category->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Category updated successfully');
    }
    public function deleteCategory($id){
        $category = Category::where('id', $id)->first();
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image)); // Delete the old logo file
        }
        $category->delete();
        return redirect()->back()->with('status', 'Category updated successfully');
    }
    public function webData($id){
        // $categories = Category::where('website_id', $id)->get();

        // return response()->json($categories);
        $categories = Category::where('website_id', $id)->get();
        $companies = Company::where('website_id', $id)->get();

        return response()->json([
            'categories' => $categories,
            'companies' => $companies,
        ]);
    }
    // end Category functions
    // start Plan functions
    public function getPlan(){
        $website = Website::where('active','1')->first();
        $plans = Plan::where('website_id', $website->id)->with('website')->get();
        return view('backend.plan.index', compact('plans'));
    }
    public function addPlan(){
        return view('backend.plan.create');
    }
    public function storePlan(Request $request){

        $request->validate([
            'name' =>'required|string',
            'description' =>'required|string',
        ]);
        $website = Website::where('active','1')->first();
        $plan= new Plan();
        $plan->description = $request->description;
        $plan->name = $request->name;
        $plan->website_id = $website->id;
        $plan->status = '1';
        $plan->save();
        return redirect()->back()->with('status', 'Plan added successfully');
    }
    public function editPlan($id){
        $plan = Plan::where('id', $id)->first();
        return view('backend.plan.edit', compact('plan'));
    }
    public function updatePlan(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'name' =>'required|string',
            'description' =>'required|string',
        ]);
        $website = Website::where('active','1')->first();
        // Find the website by ID
        $plan = Plan::find($id); // Use $id to find the correct website

        // Update the website fields
        $plan->description = $request->description;
        $plan->name = $request->name;
        $plan->website_id = $website->id;
        $plan->status = $request->status;
        $plan->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Plan updated successfully');
    }
    public function deletePlan($id){
        $plan = Plan::where('id', $id)->first();
        $plan->delete();
        return redirect()->back()->with('status', 'Plan updated successfully');
    }
    // end Plans functions
    // start Subscription functions
    public function getSubscription(){
        $subscriptions = Subscription::all();
        return view('backend.subscription.index', compact('subscriptions'));
    }
    public function addSubscription(){
        return view('backend.subscription.create');
    }
    public function storeSubscription(Request $request){

        $request->validate([
            'name' =>'required|string',
        ]);
        $subscription= new Subscription();
        $subscription->name = $request->name;
        $subscription->status = '1';
        $subscription->save();
        return redirect()->back()->with('status', 'Subscription added successfully');
    }
    public function editSubscription($id){
        $subscription = Subscription::where('id', $id)->first();
        return view('backend.subscription.edit', compact('subscription'));
    }
    public function updateSubscription(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'name' =>'required|string',
        ]);

        // Find the website by ID
        $subscription = Subscription::find($id); // Use $id to find the correct website

        // Update the website fields
        $subscription->name = $request->name;
        $subscription->status = $request->status;
        $subscription->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Subscription updated successfully');
    }
    public function deleteSubscription($id){
        $subscription = Subscription::where('id', $id)->first();
        $subscription->delete();
        return redirect()->back()->with('status', 'Subscription updated successfully');
    }
    // end Subscriptions functions
     // start Plan Details functions
    public function getPlanDetail(){
        $website = Website::where('active','1')->first();
        $plainDetails = PlanDetail::where('website_id', $website->id)->with('website','category','plan','subscription')->get();
        return view('backend.plan-detail.index', compact('plainDetails'));
    }
    public function addPlanDetail(){
        $website = Website::where('active','1')->first();
        $categories = Category::where('website_id', $website->id)->where('status','1')->get();
        $plans = Plan::where('website_id', $website->id)->where('status','1')->get();
        $subscriptions = Subscription::where('status','1')->get();
        return view('backend.plan-detail.create', compact('categories','plans','subscriptions'));
    }
    public function storePlanDetail(Request $request){
        // dd($request->all());
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'plan_id' => 'required|exists:plans,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'name.*' => 'required|string',
             'name.0' => 'nullable',
            'description.*' => 'required|string',
            'description.0' => 'nullable',
            'name_price.*' => 'required|string',
            'name_price.0' => 'nullable',
            'price.*' => 'required|numeric',
            'price.0' => 'nullable',
            'unit.*' => 'required|string',
            'unit.0' => 'nullable',
            'duration.*' => 'required|string',
            'duration.0' => 'nullable',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for images
            'image_price.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image prices
        ]);
        $website = Website::where('active','1')->first();
        $checkPlainDetail = PlanDetail::where('website_id', $website->id)
            ->where('category_id', $request->category_id)
            ->where('plan_id', $request->plan_id)
            ->where('subscription_id', $request->subscription_id)
            ->first();
        if($checkPlainDetail){
            return redirect()->back()->with('error', 'Plan Detail already exists with the same combination of website, category, plan, and subscription.');
        }
        $planDetail= new PlanDetail();
        $planDetail->website_id = $website->id;
        $planDetail->category_id = $request->category_id;
        $planDetail->plan_id = $request->plan_id;
        $planDetail->description = $request->plan_description;
        $planDetail->subscription_id = $request->subscription_id;
        $planDetail->save();
         if ($planDetail) {
        foreach ($request->name as $index => $name) {
            // Skip the first index (0)
            if ($index === 0 || is_null($name)) {
                continue;
            }

            // Prepare to save PlanDetailData
            $planDetailData = new PlanDetailData();
            $planDetailData->plan_detail_id = $planDetail->id;
            $planDetailData->name = $name;
            $planDetailData->description = $request->description[$index];
            $planDetailData->status = '1';

            // Handle image upload
            if ($request->hasFile('image') && isset($request->image[$index])) {
                $image = $request->file('image')[$index];
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/plandata'), $imageName);
                $planDetailData->image = 'images/plandata/' . $imageName;
            }

            $planDetailData->save();
        }
    }
       // Save PlanDetailPrice
    if ($planDetail) {
        foreach ($request->name_price as $index => $name_price) {
            // Skip the first index (0)
            if ($index === 0 || is_null($name_price)) {
                continue;
            }

            // Prepare to save PlanDetailPrice
            $planDetailPrice = new PlanDetailPrice();
            $planDetailPrice->plan_detail_id = $planDetail->id;
            $planDetailPrice->name = $name_price;
            $planDetailPrice->price = $request->price[$index];
            $planDetailPrice->unit = $request->unit[$index];
            $planDetailPrice->description = $request->price_description[$index];
            $planDetailPrice->duration = $request->duration[$index];
            $planDetailPrice->status = '1';

            // Handle image upload for price
            if ($request->hasFile('image_price') && isset($request->image_price[$index])) {
                $imagePrice = $request->file('image_price')[$index];
                $imagePriceName = uniqid() . '.' . $imagePrice->getClientOriginalExtension();
                $imagePrice->move(public_path('images/planprice'), $imagePriceName);
                $planDetailPrice->image = 'images/planprice/' . $imagePriceName;
            }

            $planDetailPrice->save();
        }
    }
    return redirect()->back()->with('status', 'Plan Detail added successfully');
    }
    public function editPlanDetail($id){
        $website = Website::where('active','1')->first();
        $planDetail = PlanDetail::where('id', $id)->with(['planDetailDatas', 'planDetailPrices'])->first();
        $categories = Category::where('website_id', $website->id)->where('status','1')->get();
        $plans = Plan::where('website_id', $website->id)->where('status','1')->get();
        $subscriptions = Subscription::where('status','1')->get();
        return view('backend.plan-detail.edit', compact('planDetail','categories','plans','subscriptions'));
    }
    public function updatePlanDetail(Request $request) // Add $id as a parameter
    {
        // dd($request->all());
        $id = $request->id;
        $request->validate([
            'category_id' =>'required',
            'plan_id' =>'required',
            'subscription_id' =>'required',
        ]);
        $website = Website::where('active','1')->first();
        // Find the website by ID
        $plainDetail = PlanDetail::find($id); // Use $id to find the correct website

        // Update the website fields
        $plainDetail->website_id = $website->id;
        $plainDetail->category_id = $request->category_id;
        $plainDetail->plan_id = $request->plan_id;
        $plainDetail->subscription_id = $request->subscription_id;
        $planDetail->description = $request->plan_description;
        $plainDetail->status = $request->status;
        $plainDetail->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Plan Detail updated successfully');
    }
    public function deletePlanDetail($id){
        $plainDetail = PlanDetail::where('id', $id)->first();
        if ($plainDetail->image && file_exists(public_path($plainDetail->image))) {
            unlink(public_path($plainDetail->image)); // Delete the old logo file
        }
        $plainDetail->delete();
        return redirect()->back()->with('status', 'Plan Detail updated successfully');
    }
    //extra functions
    public function addSpecification(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required', // Ensure the ID exists
            'name.*' => 'required|string|max:255', // Validate each name input
            'description.*' => 'required|string|max:1000', // Validate each description input
            'image.*' => 'nullable|image|max:2048', // Validate image if present
        ]);
        $specDetail = new PlanDetailData();
        $specDetail->plan_detail_id = $request->id;
        $specDetail->name = $request->name[0];
        $specDetail->description = $request->description[0];
        if ($request->hasFile('image')) {
            if ($specDetail->image && file_exists(public_path($specDetail->image))) {
                unlink(public_path($specDetail->image));
            }
            $image = $request->file('image')[0];
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/plandata'), $imageName);
            // Save the image path to the specDetail model
            $specDetail->image = 'images/plandata/' . $imageName;
        }
        $specDetail->save();
        return redirect()->back()->with('status', 'Plan Detail Data updated successfully');
    }
    public function updateSpecification(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plan_detail_data,id', // Ensure the ID exists
            'name.*' => 'required|string|max:255', // Validate each name input
            'description.*' => 'required|string|max:1000', // Validate each description input
            'image.*' => 'nullable|image|max:2048', // Validate image if present
        ]);
        $specDetail = PlanDetailData::find($request->id);
        $specDetail->name = $request->name[0];
        $specDetail->description = $request->description[0];
        if ($request->hasFile('image')) {
            if ($specDetail->image && file_exists(public_path($specDetail->image))) {
                unlink(public_path($specDetail->image));
            }
            $image = $request->file('image')[0];
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/plandata'), $imageName);
            // Save the image path to the specDetail model
            $specDetail->image = 'images/plandata/' . $imageName;
        }
        $specDetail->save();
        return redirect()->back()->with('status', 'Plan Detail Data updated successfully');
    }

    public function addPrice(Request $request)
    {
        // Validate the input data
        $request->validate([
            'id' => 'required',  // Ensure the ID exists
            'name_price' => 'required|string|max:255',     // Validate each name input
            'price' => 'required|string|max:255',          // Validate each price input
            'unit' => 'required|string|max:1000',          // Validate each unit input
            'image_price' => 'nullable|image|max:2048',    // Validate image if present
        ]);

        // Find the existing PlanDetailPrice record by ID
        $planDetailPrice = new PlanDetailPrice();
        $planDetailPrice->plan_detail_id = $request->id;
        $planDetailPrice->name = $request->name_price;
        $planDetailPrice->price = $request->price;
        $planDetailPrice->unit = $request->unit;
        $planDetailPrice->status = '1';
        // Handle image upload if present
        if ($request->hasFile('image_price')) {
            $imagePrice = $request->file('image_price');
            $imagePriceName = uniqid() . '.' . $imagePrice->getClientOriginalExtension();
            $imagePrice->move(public_path('images/planprice'), $imagePriceName);
            // Save the new image path
            $planDetailPrice->image = 'images/planprice/' . $imagePriceName;
        }

        // Save the updated data
        $planDetailPrice->save();

        return redirect()->back()->with('status', 'Plan Detail Price updated successfully');
    }
    public function updatePrice(Request $request)
    {
        // Validate the input data
        $request->validate([
            'id' => 'required|exists:plan_detail_prices,id',  // Ensure the ID exists
            'name_price' => 'required|string|max:255',     // Validate each name input
            'price' => 'required|string|max:255',          // Validate each price input
            'unit' => 'required|string|max:1000',          // Validate each unit input
            'image_price' => 'nullable|image|max:2048',    // Validate image if present
        ]);

        // Find the existing PlanDetailPrice record by ID
        $planDetailPrice = PlanDetailPrice::find($request->id);

        // Update the fields
        $planDetailPrice->name = $request->name_price;
        $planDetailPrice->price = $request->price;
        $planDetailPrice->description = $request->price_description;
        $planDetailPrice->unit = $request->unit;
        $planDetailPrice->status = '1';

        // Handle image upload if present
        if ($request->hasFile('image_price')) {
            // Remove the old image if it exists
            if ($planDetailPrice->image && file_exists(public_path($planDetailPrice->image))) {
                unlink(public_path($planDetailPrice->image));
            }

            // Upload the new image
            $imagePrice = $request->file('image_price');
            $imagePriceName = uniqid() . '.' . $imagePrice->getClientOriginalExtension();
            $imagePrice->move(public_path('images/planprice'), $imagePriceName);

            // Save the new image path
            $planDetailPrice->image = 'images/planprice/' . $imagePriceName;
        }

        // Save the updated data
        $planDetailPrice->save();

        return redirect()->back()->with('status', 'Plan Detail Price updated successfully');
    }

    public function removeSpecification($id)
    {
        $specDetail = PlanDetailData::find($id);
        if ($specDetail->image && file_exists(public_path($specDetail->image))) {
            unlink(public_path($specDetail->image));
        }
        $specDetail->delete();
        return redirect()->back()->with('status', 'Plan Detail Data Delated successfully');
    }
    public function removePrice($id)
    {
       $specPrice = PlanDetailPrice::find($id);
        if ($specPrice->image && file_exists(public_path($specPrice->image))) {
            unlink(public_path($specPrice->image));
        }
        $specPrice->delete();
        return redirect()->back()->with('status', 'Plan Price Data Delated successfully');
    }
    // end Plan Details functions
    // start Company functions
    public function getCompany(){
        $website = Website::where('active','1')->first();
        $companies = Company::where('website_id',$website->id)->get();
        return view('backend.company.index', compact('companies'));
    }
    public function addCompany(){
        return view('backend.company.create');
    }
    public function storeCompany(Request $request){

        $request->validate([
            'name' =>'required|unique:companies,name',
            'website_url' =>'nullable',
            'email' =>'required|unique:companies,email',
            'phone' =>'required|unique:companies,phone',
            'type' =>'required',
            'logo' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' =>'required|string',
        ]);
        $website = Website::where('active','1')->first();
        $company= new Company();
        $company->name = $request->name;
        $company->website_url = $request->website_url;
        $company->website_id = $website->id;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->type = $request->type;
        $company->address = $request->address;
        $company->status = '1';
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // Generate a unique name for the image
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            // Move the image to the public directory
            $logo->move(public_path('images/companies'), $logoName);
            // Save the image path to the shop model
            $company->logo = 'images/companies/' . $logoName;
        }
        $company->save();
        return redirect()->back()->with('status', 'Company added successfully');
    }
    public function editCompany($id){
        $company = Company::where('id', $id)->first();
        return view('backend.company.edit', compact('company'));
    }
    public function updateCompany(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        $request->validate([
            'name' => [
                'required',
                Rule::unique('companies', 'name')->ignore($id), // Use $id
            ],
            'phone' => [
                'required',
                Rule::unique('companies', 'phone')->ignore($id), // Use $id
            ],
            'email' => [
                'required',
                Rule::unique('companies', 'email')->ignore($id), // Use $id
            ],
            'website_url' =>'nullable',
            'type' =>'required',
            'logo' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' =>'required|string',
        ]);
        $website = Website::where('active','1')->first();
        // Find the company by ID
        $company = Company::find($id); // Use $id to find the correct website

        // Update the company fields
        $company->name = $request->name;
        $company->website_url = $request->website_url;
        $company->website_id = $website->id;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->type = $request->type;
        $company->address = $request->address;
        $company->status = $request->status;

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            // Check and delete the old logo file if it exists
            if ($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo)); // Delete the old logo file
            }
            // Handle the new logo upload
            $logo = $request->file('logo');
            // Generate a unique name for the image
            $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();
            // Move the image to the public directory
            $logo->move(public_path('images/companies'), $logoName);
            // Save the new image path to the website model
            $company->logo = 'images/companies/' . $logoName;
        }
        $company->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Company updated successfully');
    }
    public function deleteCompany($id){
        $company = Company::where('id', $id)->first();
        if ($company->logo && file_exists(public_path($company->logo))) {
            unlink(public_path($company->logo)); // Delete the old logo file
        }
        $company->delete();
        return redirect()->back()->with('status', 'Company deleted successfully');
    }
    // end Company functions
    // start Staff functions
    public function getStaff(){
        $website = Website::where('active','1')->first();
        $staffs = Staff::where('website_id',$website->id)->with('company')->get();
        return view('backend.staff.index', compact('staffs'));
    }
    public function addStaff(){
        $website = Website::where('active','1')->first();
        $companies = Company::where('website_id', $website->id)->with('website')->get();
        return view('backend.staff.create', compact('companies'));
    }
    public function storeStaff(Request $request){

        $request->validate([
            'company_id' =>'required',
            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'email' =>'required|unique:staff,email',
            'phone' =>'required|unique:staff,phone',
            'skill' =>'required',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' =>'required|string',
            'available_from' => 'required|date_format:H:i',
            'available_to' => 'required|date_format:H:i|after:available_from',
        ]);
        $website = Website::where('active','1')->first();
        $staff= new Staff();
        $staff->company_id = $request->company_id;
        $staff->website_id = $website->id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->skill = $request->skill;
        $staff->address = $request->address;
        $staff->available_from = $request->available_from;
        $staff->available_to = $request->available_to;
        $staff->status = '1';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/staffs'), $imageName);
            // Save the image path to the shop model
            $staff->image = 'images/staffs/' . $imageName;
        }
        $staff->save();
        return redirect()->back()->with('status', 'Staff added successfully');
    }
    public function editStaff($id){
        $website = Website::where('active','1')->first();
        $staff = Staff::where('id', $id)->first();
        $companies = Company::where('website_id', $website->id)->with('website')->get();
        return view('backend.staff.edit', compact('staff','companies'));
    }
    public function updateStaff(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        $request->validate([
            'phone' => [
                'required',
                Rule::unique('staff', 'phone')->ignore($id), // Use $id
            ],
            'email' => [
                'required',
                Rule::unique('staff', 'email')->ignore($id), // Use $id
            ],
            'company_id' =>'required',
            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'skill' =>'required',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' =>'required|string',
            'available_from' => 'required|date_format:H:i:s',
            'available_to' => 'required|date_format:H:i:s|after:available_from',
        ]);
        // Find the staff by ID
        $website = Website::where('active','1')->first();
        $staff = Staff::find($id); // Use $id to find the correct website
        // Update the staff fields
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->company_id = $request->company_id;
        $staff->website_id = $website->id;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->skill = $request->skill;
        $staff->address = $request->address;
        $staff->available_from = $request->available_from;
        $staff->available_to = $request->available_to;
        $staff->status = $request->status;
        // Handle image file upload
        if ($request->hasFile('image')) {
            // Check and delete the old image file if it exists
            if ($staff->image && file_exists(public_path($staff->image))) {
                unlink(public_path($staff->image)); // Delete the old image file
            }
            // Handle the new image upload
            $image = $request->file('image');
            // Generate a unique name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            // Move the image to the public directory
            $image->move(public_path('images/staffs'), $imageName);
            // Save the new image path to the website model
            $staff->image = 'images/staffs/' . $imageName;
        }
        $staff->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Staff updated successfully');
    }
    public function deleteStaff($id){
        $staff = Staff::where('id', $id)->first();
        if ($staff->image && file_exists(public_path($staff->image))) {
            unlink(public_path($staff->image)); // Delete the old image file
        }
        $staff->delete();
        return redirect()->back()->with('status', 'Staff deleted successfully');
    }
    // end Staff functions
    // start Booking functions
    public function getBooking(){
        $website = Website::where('active', '1')->first();
        $bookings = Booking::where('website_id', $website->id)
            ->orderBy('created_at', 'desc') // Sort by newest first
            ->get();
        return view('backend.booking.index', compact('bookings'));
    }
    public function addBooking(){
        $website = Website::where('active','1')->first();
        $companies = Company::where('website_id', $website->id)->where('status', '1')->get();
        $staffs = collect([]);
        $categories = Category::where('website_id', $website->id)->where('status','1')->get();
        $plans = Plan::where('website_id', $website->id)->where('status','1')->get();
        $subscriptions = Subscription::where('status','1')->get();
        return view('backend.booking.create', compact('categories','plans','subscriptions','companies','staffs'));
    }
    public function storeBooking(Request $request){
dd($request->all());
            $request->validate([
                'customer_name' => 'required|string',
                'customer_email' => 'nullable|email',
                'customer_phone' => 'nullable|string',
                'customer_whatsapp' => 'required|string',
                'category_id' => 'nullable|exists:categories,id',
                'plan_id' => 'nullable|exists:plans,id',
                'subscription_id' => 'nullable|exists:subscriptions,id',
                'user_id' =>'nullable|exists:users,id',
                'company_id' =>'nullable|exists:companies,id',
                'staff_id' =>'nullable|exists:staff,id',
                'service_id' =>'nullable|exists:plan_detail_prices,id',
                'customer_address' =>'nullable|string',
                'appointment_date' => 'nullable|date',
                'price' => 'nullable|numeric',
                'note' => 'nullable|string',
                'internal_note'=>'nullable|string',
                'pin_location' =>'nullable|string',
                'booking_from'=>'nullable|string',
            ]);

        $website = Website::where('active','1')->first();
        $fromDuration = $request->selected_duration; // "11:00 to 12:00"
        $serviceId = $request->service_id;
        $service = PlanDetailPrice::find($serviceId);
        $duration = (int) $service->duration; // Ensure duration is an integer (e.g., 30 minutes)
        list($startTime, $endTime) = explode(' to ', $fromDuration);
        $startDateTime = Carbon::createFromFormat('H:i', $startTime);
        $endDateTime = Carbon::createFromFormat('H:i', $endTime);
        if (!$startDateTime || !$endDateTime) {
            return response()->json(['error' => 'Invalid time format'], 400);
        }
        $newStartTime = $startDateTime->copy()->addMinutes($duration);
        $newEndTime = $endDateTime->copy()->addMinutes($duration);
        $finalDuration = "{$newStartTime->format('H:i')} to {$newEndTime->format('H:i')}";
        // dd($finalDuration);
        $booking = new Booking();
        $booking->customer_name = $request->customer_name;
        $booking->customer_email = $request->customer_email;
        $booking->customer_phone = $request->customer_phone;
        $booking->customer_whatsapp = $request->customer_whatsapp;
        $booking->duration_from = $fromDuration;
        $booking->duration_to = $finalDuration;
        $booking->website_id = $website->id;
        $booking->category_id = $request->category_id;
        $booking->plan_id = $request->plan_id;
        $booking->subscription_id = $request->subscription_id;
        $booking->user_id = $request->user_id;
        $booking->company_id = $request->company_id;
        $booking->employee_id = $request->staff_id;
        $booking->service_id = $request->service_id;
        $booking->customer_address = $request->customer_address;
        $booking->appointment_date = $request->appointment_date;
        $booking->price = $request->price;
        $booking->note = $request->note;
        $booking->internal_note = $request->internal_note;
        $booking->about_customer = $request->about_customer;
        $booking->booking_from = $request->booking_from;
        $booking->pin_location = $request->pin_location;
        $booking->status = $request->status;
        $booking->save();
        return redirect()->back()->with('status', 'Booking added successfully');
    }
    public function editBooking($id){
        $booking = Booking::find($id);
        $website = Website::where('active','1')->first();
        $companies = Company::where('website_id', $website->id)->where('status', '1')->get();
        $staffs = collect([]);
        $categories = Category::where('website_id', $website->id)->where('status','1')->get();
        $plans = Plan::where('website_id', $website->id)->where('status','1')->get();
        $subscriptions = Subscription::where('status','1')->get();
        $users = User::where('type','0')->get();
        return view('backend.booking.edit', compact('booking','users','websites','categories','plans','subscriptions','companies','staffs'));
    }
    public function updateBooking(Request $request) // Add $id as a parameter
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'name' =>'required|string',
        ]);

        // Find the website by ID
        $booking = Booking::find($id); // Use $id to find the correct website

        // Update the website fields
        $booking->name = $request->name;
        $booking->status = $request->status;
        $booking->save(); // Use save() to persist changes
        return redirect()->back()->with('status', 'Booking updated successfully');
    }
    public function deleteBooking($id){
        $booking = Booking::where('id', $id)->first();
        $booking->delete();
        return redirect()->back()->with('status', 'Booking updated successfully');
    }
    public function companyStaff($id){
        $staffs = Staff::where('company_id', $id)->get();
        return response()->json($staffs);
    }
    public function getService(Request $request)
    {
        $website = Website::where('active','1')->first();
        $categoryId = $request->input('category_id');
        $planId = $request->input('plan_id');
        $subscriptionId = $request->input('subscription_id');

        $planDetail = PlanDetail::where('website_id', $website->id)
            ->where('category_id', $categoryId)
            ->where('plan_id', $planId)
            ->where('subscription_id', $subscriptionId)
            ->first();
            // dd($planDetail);
        if ($planDetail) {
            $services = PlanDetailPrice::where('plan_detail_id', $planDetail->id)
                ->get(['id', 'name']); // Return only id and name
        } else {
            $services = [];
        }

        return response()->json(['success' => true, 'services' => $services]);
    }
    public function getPrice(Request $request)
    {
        $serviceId = $request->input('service_id');
        $service = PlanDetailPrice::find($serviceId);

        if ($service) {
            return response()->json(['success' => true, 'price' => $service->price]);
        }

        return response()->json(['success' => false, 'message' => 'Service not found']);
    }
    public function getWebsiteTiming(Request $request)
    {
        $website = Website::where('active','1')->first();
        $websiteId = $website->id;
        $date = $request->input('appointment_date') ?: now()->format('Y-m-d');
        $website = Website::find($websiteId);
        if ($website) {
            $bookings = Booking::where('website_id', $websiteId)
                ->whereDate('appointment_date', $date)
                ->get(['duration_from', 'duration_to']);
            $bookedSlots = $bookings->map(function ($booking) {
                return [
                    'start' => explode(' to ', $booking->duration_from)[0], // Example: "11:00"
                    'end'   => explode(' to ', $booking->duration_to)[1]    // Example: "12:00"
                ];
            });
            return response()->json([
                'success' => true,
                'open_time' => $website->open_time,  // Example: "08:00"
                'close_time' => $website->close_time, // Example: "22:00"
                'booked_slots' => $bookedSlots // [{ start: "11:00", end: "12:00" }, ...]
            ]);
        }
        return response()->json(['success' => false, 'message' => 'Website not found.']);
    }
    public function getCustomerDetails($whatsapp)
    {
        // Retrieve the latest booking by WhatsApp number
        $booking = Booking::where('customer_whatsapp', $whatsapp)
            ->latest('created_at')  // Get the most recent record
            ->first();
        if (!$booking) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        // Prepare and return the booking details
        return response()->json([
            'customer_name'    => $booking->customer_name,
            'customer_email'   => $booking->customer_email,
            'customer_phone'   => $booking->customer_phone,
            'customer_address' => $booking->customer_address,
            'category_id'      => $booking->category_id,
            'service_id'       => $booking->service_id,
            'note'             => $booking->note,
            'internal_note'    => $booking->internal_note,
            'status'           => $booking->status,
            'pin_location'     => $booking->pin_location,
        ]);
    }

    public function generateReport($id){
        $booking = Booking::where('id', $id)
            ->with('website','plan','subscription','category','staff')
            ->first();
        $data = [
            'title' => 'Booking Invoice',
            'booking' => $booking,
            'name' => '$booking',
        ];

        // Load the new Blade template for the PDF
        $pdf = Pdf::loadView('pdf.generate-report', $data);

        // Stream the PDF to the browser
        return $pdf->stream("booking_report_$id.pdf");
    }
    // end Booking functions
    // start User functions
    public function getUser(){
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }

   // end User functions
}