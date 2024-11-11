@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Add New Booking</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('get-booking') }}" class="btn btn-sm fw-bold btn-primary">View All</a>
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
                            <div class="col-md-12 pe-lg-10">
                                <form action="{{ route('store-booking') }}" class="form" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h1 class="fw-bold text-gray-900 mb-9">Create Booking</h1>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">Customer Whatsapp</label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="customer_whatsapp" />
                                            <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
                                        </div>
                                        <div class="col-md-1 fv-row mt-3 user-fields">
                                            <button type="button" id="fetchCustomerBtn" class="btn btn-primary mt-8 ">
                                                <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">Customer Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="customer_name" />
                                        </div>
                                        <div class="col-md-3 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">Customer Email</label>
                                            <input type="email" class="form-control form-control-solid"
                                                name="customer_email" />
                                        </div>
                                        <div class="col-md-3 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">Customer Phone</label>
                                            <input type="text" class="form-control form-control-solid"
                                                name="customer_phone" />
                                        </div>
                                        <div class="col-md-3 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">Customer Status</label>
                                            <select class="form-control form-control-solid" name="customer_status"
                                                style="font-weight: bold;">
                                                <option value="pending" style="color: #ffc107;"
                                                    {{ old('customer_status') == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="approved" style="color: #0d6efd;"
                                                    {{ old('customer_status') == 'approved' ? 'selected' : '' }}>
                                                    Approved
                                                </option>
                                                <option value="cancelled" style="color: #dc3545;"
                                                    {{ old('customer_status') == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled
                                                </option>
                                                <option value="completed" style="color: #198754;"
                                                    {{ old('customer_status') == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                                <option value="query" style="color: #0dcaf0;"
                                                    {{ old('customer_status') == 'query' ? 'selected' : '' }}>
                                                    Query
                                                </option>
                                                <option value="suspended" style="color: #6c757d;"
                                                    {{ old('customer_status') == 'suspended' ? 'selected' : '' }}>
                                                    Suspended
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Category for Booking</label>
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
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Plan for Booking</label>
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
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Subscription for Booking</label>
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
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Service</label>
                                            <select class="form-control form-control-solid" name="service_id"
                                                id="service">
                                                <option value="">Select a Service</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Price</label>
                                            <input type="text" class="form-control form-control-solid" name="price"
                                                id="price" />
                                        </div>
                                        <div class="col-md-4 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Appointment Date</label>
                                            <input type="date" class="form-control form-control-solid"
                                                name="appointment_date" id="appointment_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Duration</label>
                                            <ul class="nav nav-tabs duration-select" id="durationTabs" role="tablist">
                                            </ul>
                                            <div class="tab-content mt-3" id="durationTabContent"></div>
                                            <!-- Hidden Input to store the selected duration -->
                                            <input type="hidden" id="selectedDuration" name="selected_duration">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Companies For Booking</label>
                                                <select name="company_id" class="form-control form-control-solid"
                                                    id="companySelect">
                                                    <option value="">-- Select Company --</option>
                                                    @if ($companies->isNotEmpty())
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">
                                                                {{ $company->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Company Available</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Staff for Booking</label>
                                                <select name="staff_id" class="form-control form-control-solid"
                                                    id="staffSelect">
                                                    <option value="">-- Select Staff --</option>
                                                    @if ($staffs->isNotEmpty())
                                                        @foreach ($staffs as $staff)
                                                            @if ($staff->id !== $staffs->first()->id)
                                                                <option value="{{ $staff->id }}">
                                                                    {{ $staff->first_name }}
                                                                    {{ $staff->last_name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="">No Staff Available</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Customer Address</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="customer_address"></textarea>
                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Note</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="note"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Internal Note</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="internal_note"></textarea>
                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">About Customer</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="about_customer"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Customer Pin Location</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    name="pin_location" />
                                            </div>
                                            <div class="col-md-6 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Booking From</label>
                                                <select class="form-select form-control-solid" name="booking_from">
                                                    <option value="call">Call</option>
                                                    <option value="website">Website</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12 fv-row">
                                                <button type="submit" class="btn btn-primary mt-2"
                                                    id="kt_contact_submit_button">
                                                    <span class="indicator-label">Save</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </div>
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
            $('#fetchCustomerBtn').on('click', function() {
                const whatsapp = $('input[name="customer_whatsapp"]').val();
                // Clear previous error message
                $('#error-message').text('').hide();

                if (whatsapp) {
                    $.ajax({
                        url: `/admin/get-customer-details/${whatsapp}`,
                        type: 'GET',
                        success: function(data) {
                            // Assuming data returns an object with the required fields
                            $('input[name="customer_name"]').val(data.customer_name);
                            $('input[name="customer_email"]').val(data.customer_email);
                            $('input[name="customer_phone"]').val(data.customer_phone);
                            $('select[name="category_id"]').val(data.category_id).change();
                            $('select[name="service_id"]').val(data.service_id).change();
                            $('textarea[name="customer_address"]').val(data.customer_address);
                            $('textarea[name="note"]').val(data.note);
                            $('textarea[name="internal_note"]').val(data.internal_note);
                        },
                        error: function() {
                            $('#error-message').text('Customer not found')
                                .show(); // Show error message
                            // Optionally clear fields if needed
                            $('input[name="customer_name"], input[name="customer_email"], input[name="customer_phone"]')
                                .val('');
                            $('select[name="category_id"], select[name="service_id"]').val('')
                                .change();
                            $('textarea[name="customer_address"], textarea[name="note"], textarea[name="internal_note"]')
                                .val('');
                        }
                    });
                } else {
                    $('#error-message').text('Please enter a WhatsApp number').show(); // Show error message
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#companySelect').change(function() {
                const companyId = $(this).val();
                // Clear the current categories
                $('#staffSelect').empty().append('<option value="">Loading...</option>');
                if (companyId) {
                    $.ajax({
                        url: `/admin/company-staff/${companyId}`, // Adjust URL as needed
                        type: 'GET',
                        success: function(data) {
                            $('#staffSelect').empty(); // Clear loading message
                            if (data.length > 0) {
                                // Append new categories
                                $.each(data, function(index, staff) {
                                    $('#staffSelect').append(
                                        `<option value="${staff.id}">${staff.first_name} ${staff.last_name}</option>`
                                    );
                                });
                            } else {
                                $('#staffSelect').append(
                                    '<option value="">No Categories Available</option>');
                            }
                        },
                        error: function() {
                            $('#staffSelect').empty().append(
                                '<option value="">Error loading categories</option>');
                        }
                    });
                } else {
                    $('#staffSelect').empty().append('<option value="">No Staff Available</option>');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const planSelect = document.querySelector('select[name="plan_id"]');
            const subscriptionSelect = document.querySelector('select[name="subscription_id"]');
            const serviceSelect = document.getElementById('service');
            const priceInput = document.getElementById('price');

            // Fetch services based on selected dropdown values
            function fetchServices() {
                const categoryId = categorySelect.value;
                const planId = planSelect.value;
                const subscriptionId = subscriptionSelect.value;
                if (!categoryId || !planId || !subscriptionId) return;

                fetch('/admin/get-service', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            category_id: categoryId,
                            plan_id: planId,
                            subscription_id: subscriptionId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            populateServiceDropdown(data.services);
                        } else {
                            alert('Failed to fetch services.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Populate the service dropdown with options
            function populateServiceDropdown(services) {
                serviceSelect.innerHTML = '<option value="">Select a Service</option>'; // Reset dropdown

                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = service.name;
                    serviceSelect.appendChild(option);
                });
            }

            // Fetch price based on the selected service
            function fetchPrice() {
                const serviceId = serviceSelect.value;
                if (!serviceId) return;

                fetch('/admin/get-price', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            service_id: serviceId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            priceInput.value = data.price;
                        } else {
                            alert('Failed to fetch price.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Attach event listeners to dropdowns
            [categorySelect, planSelect, subscriptionSelect].forEach(select => {
                select.addEventListener('change', fetchServices);
            });

            // Attach event listener to service dropdown
            serviceSelect.addEventListener('change', fetchPrice);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentDateInput = document.getElementById('appointment_date');
            const durationTabs = document.getElementById('durationTabs');
            const durationTabContent = document.getElementById('durationTabContent');
            const selectedDurationInput = document.getElementById('selectedDuration');

            function fetchWebsiteTimings(date) {
                fetch(`/admin/get-website-timing`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            appointment_date: date
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            generateTimeSlots(data.open_time, data.close_time, data.booked_slots);
                        } else {
                            alert(data.message || 'Failed to fetch timings.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function generateTimeSlots(openTime, closeTime, bookedSlots) {
                const [openHour] = openTime.split(':').map(Number);
                const [closeHour] = closeTime.split(':').map(Number);
                durationTabs.innerHTML = '';
                durationTabContent.innerHTML = '';
                let currentHour = openHour;
                while (currentHour < closeHour) {
                    const nextHour = currentHour + 1;
                    const startTime = `${String(currentHour).padStart(2, '0')}:00`;
                    const endTime = `${String(nextHour).padStart(2, '0')}:00`;
                    const isBooked = bookedSlots.some(slot =>
                        (startTime >= slot.start && startTime < slot.end)
                    );
                    const tabButton = document.createElement('button');
                    tabButton.className = 'nav-link';
                    tabButton.type = 'button';
                    tabButton.textContent = `${startTime} to ${endTime}`;
                    tabButton.dataset.bsToggle = 'tab';
                    tabButton.dataset.bsTarget = `#content-${startTime.replace(':', '-')}`;
                    tabButton.dataset.duration = `${startTime} to ${endTime}`;
                    if (isBooked) {
                        tabButton.disabled = true;
                        tabButton.classList.add('disabled');
                    }
                    const tabItem = document.createElement('li');
                    tabItem.className = 'nav-item me-2 mb-2';
                    tabItem.appendChild(tabButton);
                    durationTabs.appendChild(tabItem);
                    const tabPane = document.createElement('div');
                    tabPane.className = 'tab-pane fade';
                    tabPane.id = `content-${startTime.replace(':', '-')}`;
                    tabPane.innerHTML = `<p>Selected Duration: ${startTime} to ${endTime}</p>`;
                    durationTabContent.appendChild(tabPane);
                    currentHour = nextHour;
                }
                const firstAvailableButton = durationTabs.querySelector('button:not(.disabled)');
                if (firstAvailableButton) {
                    firstAvailableButton.classList.add('active');
                    durationTabContent.firstChild.classList.add('show', 'active');
                    selectedDurationInput.value = firstAvailableButton.dataset.duration;
                }
            }
            appointmentDateInput.addEventListener('change', function() {
                const date = this.value;
                fetchWebsiteTimings(date);
            });
            fetchWebsiteTimings(appointmentDateInput.value);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentDateInput = document.getElementById('appointment_date');
            const today = new Date();
            // Set minimum date to today
            const minDate = today.toISOString().split('T')[0];
            appointmentDateInput.setAttribute('min', minDate);
            // Set maximum date to one week from today
            const maxDate = new Date();
            maxDate.setDate(today.getDate() + 7);
            appointmentDateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);
            // Set default date to today
            appointmentDateInput.value = minDate; // Set default to today
        });
    </script>
@endsection
