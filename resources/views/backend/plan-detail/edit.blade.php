@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Plan Detail</h1>
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
                    <div class="card-body p-2">
                        <div class="row mb-3">
                            <div class="col-md-12 pe-lg-12">
                                <form action="{{ route('update-plan-detail') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Edit Plan Detail</h1>
                                    <div class="row">
                                        <input type="hidden" class="form-control form-control-solid" name="id"
                                            value="{{ $planDetail->id }}" />
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Category</label>
                                            <select name="category_id" class="form-control form-control-solid"
                                                id="categorySelect">
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $planDetail->category_id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Category Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Plan</label>
                                            <select name="plan_id" class="form-control form-control-solid">
                                                @if ($plans->isNotEmpty())
                                                    @foreach ($plans as $plan)
                                                        <option value="{{ $plan->id }}"
                                                            {{ $plan->id == $planDetail->plan_id ? 'selected' : '' }}>
                                                            {{ $plan->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Plans Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Subscription</label>
                                            <select name="subscription_id" class="form-control form-control-solid">
                                                @if ($subscriptions->isNotEmpty())
                                                    @foreach ($subscriptions as $subscription)
                                                        <option value="{{ $subscription->id }}"
                                                            {{ $subscription->id == $planDetail->subscription_id ? 'selected' : '' }}>
                                                            {{ $subscription->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Subscription Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Status</label>
                                            <select name="status" class="form-control form-control-solid">
                                                <option value="1" {{ $planDetail->status == 1 ? 'selected' : '' }}>
                                                    Show</option>
                                                <option value="0" {{ $planDetail->status == 0 ? 'selected' : '' }}>
                                                    Hide</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <button type="submit" class="btn btn-primary update-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <h1 class="fw-bold text-gray-900 mb-9">Plan Detail Data</h1>
                                {{-- start code here --}}
                                <form action="{{ route('add-specification') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Name for Detail <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="name[]" id="name" />
                                            <input type="hidden" class="form-control form-control-solid" name="id"
                                                value="{{ $planDetail->id }}" />
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Image for Detail <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                name="image[]" id="image" />
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid" rows="1" name="description[]" placeholder="" id="description"></textarea>
                                        </div>
                                        <div class="mt-1 col-2 d-flex align-items-end">
                                            <button type="submit" id="addSpecification"
                                                class="btn btn-primary"><i class="fa-solid fa-plus p-0"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div id="specificationsContainer"></div>
                                {{-- Specifications inputs start here --}}
                                @foreach ($planDetail->planDetailDatas as $specificationDetail)
                                    <form class="price-detail-form" action="{{ route('update-specification') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-2" data-id="{{ $specificationDetail->id }}">
                                            <div class="col-md-3 fv-row">
                                                <input type="hidden" class="form-control form-control-solid"
                                                    value="{{ $specificationDetail->id }}" name="id" />
                                                <input type="text" class="form-control form-control-solid"
                                                    value="{{ $specificationDetail->name }}" name="name[]" />
                                            </div>
                                            <div class="col-md-3 fv-row">
                                                @if ($specificationDetail->image)
                                                    <img src="/{{ $specificationDetail->image }}" alt="Detail Image"
                                                        class="img-thumbnail float-start"
                                                        style="width:50px; height:50px;">
                                                @endif
                                                <input type="file" name="image[]"
                                                    class="form-control mt-2 float-start w-75" accept="image/*" />
                                            </div>
                                            <div class="col-md-3 fv-row">
                                                <textarea class="form-control form-control-solid" rows="1" name="description[]">{{ $specificationDetail->description }}</textarea>
                                            </div>
                                            <div class="col-1 p-0">
                                                <button type="submit"
                                                    class="btn btn-primary updateSpecification float-start"><i class="fa-solid fa-pen-to-square p-0"></i></button>
                                                <a href="{{ url('admin/remove-specification/' . $specificationDetail->id) }}"
                                                    class="btn btn-danger removePrice ms-2 float-start"><i class="fa-solid fa-minus p-0"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                                {{-- end code here --}}
                                <hr>
                                <h1 class="fw-bold text-gray-900 mb-9">Plan Detail Price</h1>
                                {{-- start code here --}}
                                <form action="{{ route('add-price') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Name for price <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="name_price" id="name_price" />
                                            <input type="hidden" class="form-control form-control-solid" name="id"
                                                value="{{ $planDetail->id }}" />
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Image of Item <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-solid" placeholder=""
                                                name="image_price" id="image_price" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Price <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="price" id="price" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Currency Unit <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="unit" id="unit" />
                                        </div>
                                        <div class="col-md-2 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Duration(minute) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="duration" id="duration" />
                                        </div>
                                        <div class="col-1 p-0">
                                            <button type="submit" id="addPrice" class="btn btn-primary update-btn"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div id="priceContainer"></div>
                                {{-- Price inputs start here --}}
                                @foreach ($planDetail->planDetailPrices as $priceDetail)
                                    <form action="{{ route('update-price') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="col-md-2 fv-row">
                                                <input type="text" class="form-control form-control-solid price-name"
                                                    value="{{ $priceDetail->name }}" name="name_price" required />
                                                <input type="hidden" class="form-control form-control-solid price-name"
                                                    value="{{ $priceDetail->id }}" name="id" />
                                            </div>
                                            <div class="col-md-3 fv-row">
                                                @if ($priceDetail->image)
                                                    <img src="/{{ $priceDetail->image }}" alt="Price Image"
                                                        class="img-thumbnail float-start"
                                                        style="width:50px; height:50px;">
                                                @endif
                                                <input type="file"
                                                    class="form-control form-control-solid mt-2 float-start w-75"
                                                    name="image_price" />
                                            </div>
                                            <div class="col-md-2 fv-row">
                                                <input type="text" class="form-control form-control-solid price-value"
                                                    value="{{ $priceDetail->price }}" name="price" required />
                                            </div>
                                            <div class="col-md-2 fv-row">
                                                <input type="text" class="form-control form-control-solid price-unit"
                                                    value="{{ $priceDetail->unit }}" name="unit" required />
                                            </div>
                                            <div class="col-md-2 fv-row">
                                                <input type="text" class="form-control form-control-solid price-duration"
                                                    value="{{ $priceDetail->duration }}" name="duration" required />
                                            </div>
                                            <div class=" col-md-1 p-0">
                                                <button type="submit" class="btn btn-primary updatePrice float-start"><i class="fa-solid fa-pen-to-square p-0"></i></button>
                                                <a href="{{ url('admin/remove-price/' . $priceDetail->id) }}"
                                                    class="btn btn-danger removePrice ms-2 float-start"><i class="fa-solid fa-minus p-0"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                                <hr>
                                {{-- end code here --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
