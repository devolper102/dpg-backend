@extends('admin-includes.master')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Staff</h1>
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
                                <form action="{{ route('update-staff') }}" class="form mb-15" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Edit Staff</h1>
                                    <input type="hidden" value="{{ $staff->id }}"
                                        class="form-control form-control-solid" name="id" />
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Staff Company</label>
                                            <select name="company_id" class="form-control form-control-solid"
                                                id="companySelect">
                                                <option value="">-- Select User --</option>
                                                @if ($companies->isNotEmpty())
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}"
                                                            {{ $staff->company_id == $company->id ? 'selected' : '' }}>
                                                            {{ $company->name }}</option>
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
                                                value="{{ old('first_name', $staff->first_name) }}" required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="last_name"
                                                value="{{ old('last_name', $staff->last_name) }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-solid" name="email"
                                                value="{{ old('email', $staff->email) }}" required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="phone"
                                                value="{{ old('phone', $staff->phone) }}" required />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <div class="row mb-3">
                                                <div class="d-flex col-md-6 flex-column mb-5 fv-row">
                                                    <label class="fs-5 fw-semibold mb-2 mt-2">Image</label>
                                                    <input type="file" class="form-control form-control-solid"
                                                        name="image" />
                                                </div>
                                                <div class="d-flex col-md-6 flex-column mb-5 fv-row">
                                                    <label class="fs-5 fw-semibold mb-2 mt-2">Existing Image</label>
                                                    <img src="{{ asset('/' . $staff->image) }}" alt="Image"
                                                        width="60" height="60">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Skill <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-solid" name="skill"
                                                value="{{ old('skill', $staff->skill) }}" required />
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Available From <span
                                                    class="text-danger">*</span></label>
                                            <select name="available_from" class="form-control form-control-solid"
                                                id="availableFromSelect" required>
                                                <option value="">Select Available From</option>
                                                <!-- Options will be populated via JavaScript -->
                                            </select>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Available To <span
                                                    class="text-danger">*</span></label>
                                            <select name="available_to" class="form-control form-control-solid"
                                                id="availableToSelect" required>
                                                <option value="">Select Available To</option>
                                                <!-- Options will be populated via JavaScript -->
                                            </select>
                                        </div>
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Show Status</label>
                                            <select name="status" class="form-control form-control-solid">
                                                <option value="1" {{ $staff->status == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ $staff->status == '0' ? 'selected' : '' }}>
                                                    Blocked
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">Address <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid" rows="3" name="address">{{ old('address', $staff->address) }}</textarea>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const companies = @json($companies);
            const staff = @json($staff);

            const selectedCompanyId = staff.company_id;
            const company = companies.find(c => c.id == selectedCompanyId);

            if (company && company.website) {
                const openTime = company.website.open_time;
                const closeTime = company.website.close_time;

                // Populate time slots when the page loads
                populateTimeSlots(openTime, closeTime);

                // Set the selected times after the options are populated
                setTimeout(() => {
                    $('#availableFromSelect').val(formatTime(staff.available_from));
                    updateAvailableToOptions(staff.available_from, closeTime, formatTime(staff
                        .available_to)); // Preserve selected "Available To" value
                }, 100);
            }
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
            // Populate Available From and To dropdowns
            function populateTimeSlots(openTime, closeTime) {
                const fromSelect = $('#availableFromSelect');
                const toSelect = $('#availableToSelect');

                // Reset the options
                fromSelect.empty().append('<option value="">Select Available From</option>');
                toSelect.empty().append('<option value="">Select Available To</option>');

                let start = new Date(`1970-01-01T${openTime}`);
                const end = new Date(`1970-01-01T${closeTime}`);

                // Populate "Available From" dropdown
                while (start < end) {
                    const time = start.toTimeString().slice(0, 8); // Format HH:MM:SS
                    fromSelect.append(`<option value="${time}">${time.slice(0, 5)}</option>`); // Display HH:MM
                    start.setMinutes(start.getMinutes() + 60); // Increment by 60 minutes
                }

                // Listen for changes in the "Available From" dropdown
                $('#availableFromSelect').on('change', function() {
                    const selectedTime = $(this).val();
                    updateAvailableToOptions(selectedTime,
                    closeTime); // Update "Available To" options based on selection
                });
            }

            // Update Available To dropdown based on selected "Available From" time
            function updateAvailableToOptions(fromTime, closeTime, preSelectedToTime = null) {
                const toSelect = $('#availableToSelect');
                toSelect.empty().append('<option value="">Select Available To</option>');

                if (!fromTime) return; // If no "Available From" time selected, don't update

                let start = new Date(`1970-01-01T${fromTime}`);
                const end = new Date(`1970-01-01T${closeTime}`);

                // Add 1 hour to the "Available From" time
                start.setHours(start.getHours() + 1);

                // Populate "Available To" options starting 1 hour after "Available From"
                while (start <= end) {
                    const time = start.toTimeString().slice(0, 8); // Format HH:MM:SS
                    toSelect.append(`<option value="${time}">${time.slice(0, 5)}</option>`); // Display HH:MM
                    start.setMinutes(start.getMinutes() + 60); // Increment by 60 minutes
                }

                // If a pre-selected "Available To" value exists, set it
                if (preSelectedToTime) {
                    setTimeout(() => {
                        $('#availableToSelect').val(preSelectedToTime);
                    }, 50);
                }
            }

            function clearTimeSlots() {
                $('#availableFromSelect').empty().append('<option value="">Select Available From</option>');
                $('#availableToSelect').empty().append('<option value="">Select Available To</option>');
            }

            // Helper function to format time as HH:MM:SS
            function formatTime(time) {
                if (!time) return '';
                const [hours, minutes, seconds] = time.split(':');
                return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}:00`;
            }
        });
    </script>
@endsection
