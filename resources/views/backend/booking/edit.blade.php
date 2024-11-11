@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Booking</h1>
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
                                    <h1 class="fw-bold text-gray-900 mb-9">Edit booking</h1>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">User Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $booking->customer_name }}" name="user_name" id="userName"
                                                placeholder="Enter User Name" />
                                        </div>
                                        <div class="col-md-4 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">User Email</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $booking->customer_email }}" name="user_email" id="userEmail"
                                                placeholder="Enter User Email" />
                                        </div>
                                        <div class="col-md-4 fv-row mt-3 user-fields">
                                            <label class="fs-5 fw-semibold mb-2">User Phone</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $booking->customer_phone }}" name="user_phone" id="userPhone"
                                                placeholder="Enter User Phone" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Website for Booking</label>
                                            {{-- <select name="website_id" class="form-control form-control-solid"
                                                id="websiteSelect">
                                                @if ($websites->isNotEmpty())
                                                    @foreach ($websites as $website)
                                                        <option value="{{ $website->id }}"
                                                            {{ $website->id === $websites->first()->id ? 'selected' : '' }}>
                                                            {{ $website->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Website Available</option>
                                                @endif
                                            </select> --}}
                                            <select name="website_id" class="form-control form-control-solid"
                                                id="websiteSelect">
                                                @if ($websites->isNotEmpty())
                                                    @foreach ($websites as $website)
                                                        <option value="{{ $website->id }}"
                                                            {{ $website->id == $booking->website_id ? 'selected' : '' }}>
                                                            {{ $website->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Website Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        {{-- <div class="col-md-3 fv-row">
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
                                        </div> --}}
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Category for Booking</label>
                                            <select name="category_id" class="form-control form-control-solid"
                                                id="categorySelect">
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $booking->category_id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Category Available</option>
                                                @endif
                                            </select>
                                        </div>

                                        {{-- <div class="col-md-3 fv-row">
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
                                        </div> --}}
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Plan for Booking</label>
                                            <select name="plan_id" class="form-control form-control-solid">
                                                @if ($plans->isNotEmpty())
                                                    @foreach ($plans as $plan)
                                                        <option value="{{ $plan->id }}"
                                                            {{ $plan->id == $booking->plan_id ? 'selected' : '' }}>
                                                            {{ $plan->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Plans Available</option>
                                                @endif
                                            </select>
                                        </div>
                                        {{-- <div class="col-md-3 fv-row">
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
                                        </div> --}}
                                        <div class="col-md-3 fv-row">
                                            <label class="fs-5 fw-semibold mb-2 mt-2">Subscription for Booking</label>
                                            <select name="subscription_id" class="form-control form-control-solid">
                                                @if ($subscriptions->isNotEmpty())
                                                    @foreach ($subscriptions as $subscription)
                                                        <option value="{{ $subscription->id }}"
                                                            {{ $subscription->id == $booking->subscription_id ? 'selected' : '' }}>
                                                            {{ $subscription->name }}
                                                        </option>
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
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $booking->price }}" name="price" id="price" />
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
                                            {{-- <div class="col-md-4 fv-row">
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
                                            </div> --}}
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Companies For Booking</label>
                                                <select name="company_id" class="form-control form-control-solid"
                                                    id="companySelect">
                                                    <option value="">-- Select Company --</option>
                                                    @if ($companies->isNotEmpty())
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}"
                                                                {{ $booking->company_id == $company->id ? 'selected' : '' }}>
                                                                {{ $company->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Company Available</option>
                                                    @endif
                                                </select>
                                            </div>
                                            {{-- <div class="col-md-4 fv-row">
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
                                            </div> --}}
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Staff for Booking</label>
                                                <select name="staff_id" class="form-control form-control-solid"
                                                    id="staffSelect">
                                                    <option value="">-- Select Staff --</option>
                                                    @if ($staffs->isNotEmpty())
                                                        @foreach ($staffs as $staff)
                                                            @if ($staff->id !== $staffs->first()->id)
                                                                <option value="{{ $staff->id }}"
                                                                    {{ $booking->staff_id == $staff->id ? 'selected' : '' }}>
                                                                    {{ $staff->first_name }} {{ $staff->last_name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="">No Staff Available</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Status of Booking</label>
                                                <select name="status" class="form-control form-control-solid"
                                                    id="staffSelect">
                                                    <option value="active"
                                                        {{ $booking->status === 'active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="pending"
                                                        {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $booking->status === 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="cancelled"
                                                        {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Customer Address</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="customer_address">{{ $booking->customer_address }}</textarea>
                                            </div>
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Note</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="note">{{ $booking->note }}</textarea>
                                            </div>
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-5 fw-semibold mb-2 mt-2">Internal Note</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="internal_note">{{ $booking->internal_note }}</textarea>
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
        document.addEventListener('DOMContentLoaded', function() {
            const websiteSelect = document.getElementById('websiteSelect');
            const categorySelect = document.getElementById('categorySelect');
            const companySelect = document.getElementById('companySelect');

            function fetchWebData() {
                const selectedWebsiteId = websiteSelect.value;
                // Clear both dropdowns initially
                categorySelect.innerHTML = '<option value="">Loading Categories...</option>';
                companySelect.innerHTML = '<option value="">Loading Companies...</option>';
                if (!selectedWebsiteId) {
                    categorySelect.innerHTML = '<option value="">No Category Available</option>';
                    companySelect.innerHTML = '<option value="">No Company Available</option>';
                    return;
                }
                fetch(`/admin/web-data/${selectedWebsiteId}`)
                    .then(response => response.json())
                    .then(data => {
                        populateDropdown(categorySelect, data.categories, 'Category');
                        populateDropdown(companySelect, data.companies, 'Company');
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        categorySelect.innerHTML = '<option value="">Error loading categories</option>';
                        companySelect.innerHTML = '<option value="">Error loading companies</option>';
                    });
            }

            function populateDropdown(selectElement, items, itemType) {
                selectElement.innerHTML = `<option value="">-- Select ${itemType} --</option>`;
                if (items.length > 0) {
                    items.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        selectElement.appendChild(option);
                    });
                } else {
                    selectElement.innerHTML += `<option value="">No ${itemType} Available</option>`;
                }
            }
            websiteSelect.addEventListener('change', fetchWebData);
            // Trigger change event on load to populate default options
            websiteSelect.dispatchEvent(new Event('change'));
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const websiteSelect = document.getElementById('websiteSelect');
            const categorySelect = document.getElementById('categorySelect');
            const planSelect = document.querySelector('select[name="plan_id"]');
            const subscriptionSelect = document.querySelector('select[name="subscription_id"]');
            const serviceSelect = document.getElementById('service');
            const priceInput = document.getElementById('price');
            // Fetch services based on selected dropdown values
            function fetchServices() {
                const websiteId = websiteSelect.value;
                const categoryId = categorySelect.value;
                const planId = planSelect.value;
                const subscriptionId = subscriptionSelect.value;
                if (!websiteId || !categoryId || !planId || !subscriptionId) return;
                fetch('/admin/get-service', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            website_id: websiteId,
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
            [websiteSelect, categorySelect, planSelect, subscriptionSelect].forEach(select => {
                select.addEventListener('change', fetchServices);
            });

            // Attach event listener to service dropdown
            serviceSelect.addEventListener('change', fetchPrice);
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const websiteSelect = document.getElementById('websiteSelect');
            const categorySelect = document.getElementById('categorySelect');
            const planSelect = document.querySelector('select[name="plan_id"]');
            const subscriptionSelect = document.querySelector('select[name="subscription_id"]');
            const serviceSelect = document.getElementById('service');
            const priceInput = document.getElementById('price');

            // Fetch services based on selected dropdown values
            function fetchServices() {
                const websiteId = websiteSelect.value;
                const categoryId = categorySelect.value;
                const planId = planSelect.value; // Current selected plan ID
                const subscriptionId = subscriptionSelect.value;

                if (!websiteId || !categoryId || !planId || !subscriptionId) return;

                fetch('/admin/get-service', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            website_id: websiteId,
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
            [websiteSelect, categorySelect, subscriptionSelect].forEach(select => {
                select.addEventListener('change', fetchServices);
            });

            // Attach event listener to service dropdown
            serviceSelect.addEventListener('change', fetchPrice);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const websiteSelect = document.getElementById('websiteSelect');
            const appointmentDateInput = document.getElementById('appointment_date');
            const durationTabs = document.getElementById('durationTabs');
            const durationTabContent = document.getElementById('durationTabContent');
            const selectedDurationInput = document.getElementById('selectedDuration');

            function fetchWebsiteTimings(websiteId, date) {
                fetch(`/admin/get-website-timing`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            website_id: websiteId,
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
            websiteSelect.addEventListener('change', function() {
                const websiteId = this.value;
                const date = appointmentDateInput.value;
                fetchWebsiteTimings(websiteId, date);
            });
            appointmentDateInput.addEventListener('change', function() {
                const websiteId = websiteSelect.value;
                const date = this.value;
                fetchWebsiteTimings(websiteId, date);
            });
            fetchWebsiteTimings(websiteSelect.value, appointmentDateInput.value);
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
