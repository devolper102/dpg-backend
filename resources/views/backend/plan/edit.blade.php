@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Plan</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-plan') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
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
                <div class="card">
                    <div class="card-body p-lg-17">
                        <div class="row mb-3">
                            <div class="col-md-10 pe-lg-10">
                                <form action="{{ route('update-plan') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Edit Plan</h1>
                                    <input type="hidden" value="{{ $plan->id }}"
                                        class="form-control form-control-solid" placeholder="" name="id" />
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-5 fw-semibold mb-2 ">Plan Name</label>
                                        <input type="text" value="{{ $plan->name }}"
                                            class="form-control form-control-solid" placeholder="" name="name" />
                                    </div>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-5 fw-semibold mb-2 ">Plan Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3">{{ $plan->description }}</textarea>
                                    </div>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-5 fw-semibold mb-2">Show Status</label>
                                        <select name="status" class="form-control form-control-solid">
                                            <option value="1" {{ $plan->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $plan->status == '0' ? 'selected' : '' }}>Blocked
                                            </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
                                        <span class="indicator-label">Update</span>
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
