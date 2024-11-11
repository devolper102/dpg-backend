@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Add New Company</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-company') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
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
                            <div class="col-md-10 pe-lg-10">
                                <form action="{{ route('store-company') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Create Company</h1>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 ">Company Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="name" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Url</label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="website_url" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-solid" name="email" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="phone" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Logo</label>
                                            <input type="file" class="form-control form-control-solid" name="logo" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Type <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="type" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Company Commission <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-solid"
                                                name="commission" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Company Address <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid" rows="3" name="address"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
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
@endsection
