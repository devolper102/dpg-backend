@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Add New Staff</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-staff') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
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
                                <form action="{{ route('store-staff') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Create staff</h1>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Staff Company</label>
                                            <select name="company_id" class="form-control form-control-solid"
                                                id="companySelect">
                                                <option value="">-- Select User --</option>
                                                @if ($companies->isNotEmpty())
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Companies Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="first_name"
                                                required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="last_name"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-solid" name="email"
                                                required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="phone"
                                                required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Image</label>
                                            <input type="file" class="form-control form-control-solid" name="image" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Skill <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="skill"
                                                required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Available From <span
                                                    class="text-danger">*</span></label>
                                            <select name="available_from" class="form-control form-control-solid"
                                                id="availableFromSelect" required>
                                                <option value="">Select Available From</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Available To <span
                                                    class="text-danger">*</span></label>
                                            <select name="available_to" class="form-control form-control-solid"
                                                id="availableToSelect" required>
                                                <option value="">Select Available To</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Address <span
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const companies = @json($companies);
            // Handle company selection change
            $('#companySelect').on('change', function() {
                const selectedCompanyId = $(this).val();
                const company = companies.find(c => c.id == selectedCompanyId);
                if (company && company.website) {
                    const openTime = company.website.open_time;
                    const closeTime = company.website.close_time;
                    populateTimeSlots(openTime, closeTime);
                } else {
                    clearTimeSlots();
                }
            });

            function populateTimeSlots(openTime, closeTime) {
                const fromSelect = $('#availableFromSelect');
                const toSelect = $('#availableToSelect');

                // Reset the options
                fromSelect.empty().append('<option value="">Select Available From</option>');
                toSelect.empty().append('<option value="">Select Available To</option>');

                // Initialize start and end time as Date objects
                let start = new Date(`1970-01-01T${openTime}`);
                const end = new Date(`1970-01-01T${closeTime}`);

                // Populate the "Available From" options
                while (start < end) {
                    const time = start.toTimeString().slice(0, 5); // Format HH:MM
                    fromSelect.append(`<option value="${time}">${time}</option>`);
                    start.setMinutes(start.getMinutes() + 60); // Increment by 30 minutes
                }

                // Handle the change event of the first dropdown
                fromSelect.on('change', function() {
                    const selectedTime = $(this).val(); // Get selected time from the first column
                    const newStart = new Date(`1970-01-01T${selectedTime}`);
                    newStart.setHours(newStart.getHours() + 1); // Start 1 hour after the selected time

                    // Clear and repopulate the "Available To" dropdown
                    toSelect.empty().append('<option value="">Select Available To</option>');
                    let nextEnd = new Date(`1970-01-01T${closeTime}`);

                    while (newStart < nextEnd) {
                        const time = newStart.toTimeString().slice(0, 5); // Format HH:MM
                        toSelect.append(`<option value="${time}">${time}</option>`);
                        newStart.setMinutes(newStart.getMinutes() + 60); // Increment by 30 minutes
                    }
                });
            }

            function clearTimeSlots() {
                $('#availableFromSelect, #availableToSelect').empty().append(
                    '<option value="">Select Time</option>');
            }
        });
    </script>
@endsection
