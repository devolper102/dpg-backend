@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Add New Plan Detail</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-plan-detail') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="row mb-3">
                            <div class="col-md-12 pe-lg-12">
                                <form action="{{ route('store-plan-detail') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Create Plan Detail</h1>
                                    <div class="row">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Category for Details</label>
                                            <select name="category_id" class="form-control form-control-solid"
                                                id="categorySelect">
                                                @if ($categories->isNotEmpty())
                                                    <option value="{{ $categories->first()->id }}" selected>
                                                        {{ $categories->first()->name }}</option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->id !== $categories->first()->id)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">No Category Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Plan for Details</label>
                                            <select name="plan_id" class="form-control form-control-solid">
                                                @if ($plans->isNotEmpty())
                                                    <option value="{{ $plans->first()->id }}" selected>
                                                        {{ $plans->first()->name }}</option>
                                                    @foreach ($plans as $plan)
                                                        @if ($plan->id !== $plans->first()->id)
                                                            <option value="{{ $plan->id }}">{{ $plan->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">No Plans Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Subscription for Details</label>
                                            <select name="subscription_id" class="form-control form-control-solid">
                                                @if ($subscriptions->isNotEmpty())
                                                    <option value="{{ $subscriptions->first()->id }}" selected>
                                                        {{ $subscriptions->first()->name }}</option>
                                                    @foreach ($subscriptions as $subscription)
                                                        @if ($subscription->id !== $subscriptions->first()->id)
                                                            <option value="{{ $subscription->id }}">
                                                                {{ $subscription->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">No Subscription Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Plan Description</label>
                                            <textarea  class="form-control form-control-solid" placeholder="Description"
                                                name="plan_description" rows="3">
                                                </textarea>
                                        </div>
                                    </div>

                                    <hr>
                                    <h1 class="fw-bold text-gray-900 mb-9">Plan Detail Data</h1>
                                    <div class="row">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Name for Detail <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="name[]" id="name" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Image for Detail <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                name="image[]" id="image" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2 w-100 d-inline-block">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid w-75 float-start me-3" rows="1" name="description[]" placeholder="" id="description"></textarea>
                                            <button type="button" id="addSpecification" class="btn btn-primary"><i
                                                    class="fa-solid fa-plus p-0"></i></button>
                                        </div>

                                    </div>
                                    <div id="specificationsContainer"></div>
                                    <hr>
                                    <h1 class="fw-bold text-gray-900 mb-9">Plan Detail Price</h1>
                                    <div class="row">
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Name for price <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="name_price[]" id="name_price" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Image of Item <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                name="image_price[]" id="image_price" />
                                        </div>
                                        <div class="col-md-1 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Price <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="price[]" id="price" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Currency Unit <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="unit[]" id="unit" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Duration(minute) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="duration[]" id="duration" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea  class="form-control form-control-solid" placeholder="Description"
                                                name="price_description[]" id="price_description" rows="1">
                                                </textarea>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" id="addPrice" class="btn btn-primary" style="margin-top: 33px;">
                                                <i class="fa-solid fa-plus p-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="priceContainer"></div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary mt-2" id="kt_contact_submit_button">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add specification
            $('#addSpecification').click(function() {
                const name = $('#name').val();
                const imageInput = $('#image')[0]; // Original file input element
                const description = $('#description').val();
                if (name && imageInput.files.length > 0 && description) {
                    // Clone the original file input (without resetting)
                    const newImageInput = $(imageInput).clone(true);
                    // Create the new specification row with the cloned input
                    const newSpecification = `
                <div class="row mt-2">
                    <div class="col-md-4 fv-row">
                        <input type="text" class="form-control form-control-solid" value="${name}" name="name[]" />
                    </div>
                    <div class="col-md-4 fv-row">
                    </div>
                    <div class="col-md-4 fv-row">
                        <textarea class="form-control form-control-solid w-75 float-start me-3" rows="1" name="description[]">${description}</textarea>
                        <button type="button" class="btn btn-danger removeSpecification "><i class="fa-solid fa-minus p-0"></i></button>
                    </div>
                    <div class="col-1 align-items-end">
                    </div>
                </div>`;

                    // Append the new row to the container
                    const newRow = $(newSpecification);
                    newRow.find('.col-md-4.fv-row').eq(1).append(newImageInput); // Add the cloned input

                    $('#specificationsContainer').append(newRow);

                    // Clear the input fields for the next entry
                    $('#name').val('');
                    $('#image').val(''); // Reset the original input
                    $('#description').val('');
                } else {
                    alert('Please fill out all fields');
                }
            });
            // Remove specification row
            $(document).on('click', '.removeSpecification', function() {
                $(this).closest('.row').remove();
            });
            // Add price
            $('#addPrice').click(function() {
                const namePrice = $('#name_price').val();
                const imagePriceInput = $('#image_price')[0]; // Original file input element
                const price = $('#price').val();
                const unit = $('#unit').val();
                const duration = $('#duration').val();
                const price_description = $('#price_description').val();

                if (namePrice && imagePriceInput.files.length > 0 && price && unit && duration) {
                    // Clone the original file input (without resetting)
                    const newImagePriceInput = $(imagePriceInput).clone(true);

                    // Create the new price row with the cloned input
                    const newPrice = `
                <div class="row mt-2">
                    <div class="col-md-2 fv-row">
                        <input type="text" class="form-control form-control-solid" value="${namePrice}" name="name_price[]" />
                    </div>
                    <div class="col-md-2 fv-row">
                    </div>
                    <div class="col-md-2 fv-row">
                        <input type="text" class="form-control form-control-solid" value="${price}" name="price[]" />
                    </div>
                    <div class="col-md-2 fv-row">
                        <input type="text" class="form-control form-control-solid" value="${unit}" name="unit[]" />
                    </div>
                    <div class="col-md-2 fv-row">
                        <input type="text" class="form-control form-control-solid" value="${duration}" name="duration[]" />
                    </div>
                     <div class="col-md-2 fv-row">
                        
                        <textarea  class="form-control form-control-solid"
                                                name="price_description[]" rows="1">${price_description}
                                                </textarea>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-danger removePrices"><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>`;

                    // Append the new row to the container
                    const newRow = $(newPrice);
                    newRow.find('.col-md-2.fv-row').eq(1).append(
                        newImagePriceInput); // Add the cloned input

                    $('#priceContainer').append(newRow);

                    // Clear the input fields for the next entry
                    $('#name_price').val('');
                    $('#image_price').val(''); // Reset the original input
                    $('#price').val('');
                    $('#unit').val('');
                    $('#duration').val('');
                } else {
                    alert('Please fill out required fields');
                }
            });

            // Remove price row
            $(document).on('click', '.removePrices', function() {
                $(this).closest('.row').remove();
            });
            //end add price
        });
    </script>
@endsection
