@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Website</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-website') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
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
                                <form action="{{ route('update-website') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Edit Website</h1>
                                    <input type="hidden" value="{{ $website->id }}"
                                        class="form-control form-control-solid" placeholder="" name="id" />
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 ">Website Name</label>
                                            <input type="text" value="{{ $website->name }}"
                                                class="form-control form-control-solid" placeholder="" name="name" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Website Url</label>
                                            <input type="text" value="{{ $website->url }}"
                                                class="form-control form-control-solid" placeholder="" name="url" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Contact No</label>
                                            <input type="text" value="{{ $website->contact }}"
                                                class="form-control form-control-solid" placeholder="" name="contact" />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <div class="row">
                                                <div class="d-flex col-md-8 flex-column mb-5 fv-row">
                                                    <label class="fs-5 fw-semibold mb-2 mt-2">Website Logo</label>
                                                    <input type="file" class="form-control form-control-solid"
                                                        placeholder="" name="logo" />
                                                </div>
                                                <div class="d-flex col-md-4 flex-column mb-5 fv-row">
                                                    <label class="fs-5 fw-semibold mb-2 mt-2">Existing</label>
                                                    <img src="{{ asset('/' . $website->logo) }}" alt="Logo"
                                                        width="60" height="60">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Open Time <span
                                                    class="text-danger">*</span></label>
                                            <input type="time" class="form-control form-control-solid"
                                                value="{{ \Carbon\Carbon::parse($website->open_time)->format('H:i') }}"
                                                name="open_time" required />
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Close Time<span
                                                    class="text-danger">*</span></label>
                                            <input type="time" class="form-control form-control-solid"
                                                value="{{ \Carbon\Carbon::parse($website->close_time)->format('H:i') }}"
                                                name="close_time" required />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Address</label>
                                            <textarea class="form-control form-control-solid" rows="2" name="address" placeholder="">{{ $website->address }}</textarea>
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                            <textarea class="form-control form-control-solid" rows="2" name="description" placeholder="">{{ $website->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Show Status</label>
                                            <select name="status" class="form-control form-control-solid">
                                                <option value="1" {{ $website->status == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ $website->status == '0' ? 'selected' : '' }}>
                                                    Blocked
                                                </option>
                                            </select>
                                        </div>
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
