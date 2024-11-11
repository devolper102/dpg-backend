@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Bookings</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('add-booking') }}" class="btn btn-sm fw-bold btn-primary">Add New</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this booking?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">All Bookings</span>
                        </h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-40px">Sr#</th>
                                        <th class="min-w-125px">Customer Name</th>
                                        <th class="min-w-125px">Customer Email</th>
                                        <th class="min-w-125px">Customer Phone</th>
                                        <th class="min-w-125px">Appointment Date</th>
                                        <th class="min-w-125px">Appointment From</th>
                                        <th class="min-w-125px">Appointment To</th>
                                        <th class="min-w-80px">Status</th>
                                        <th class="min-w-150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($bookings))
                                        @foreach ($bookings as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->customer_name }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->customer_email }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->customer_phone }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->appointment_date }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->duration_from }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->duration_to }}</span>
                                                </td>
                                                {{-- <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->status }}</span>
                                                </td> --}}
                                                <td>
                                                    <span
                                                        class="badge
        {{ $item->status === 'pending' ? 'bg-warning' : '' }}
        {{ $item->status === 'approved' ? 'bg-primary' : '' }}
        {{ $item->status === 'cancelled' ? 'badge-danger' : '' }}
        {{ $item->status === 'completed' ? 'badge-success' : '' }}
        {{ $item->status === 'query' ? 'bg-info' : '' }}
        {{ $item->status === 'suspended' ? 'bg-secondary' : '' }}
        fs-7 fw-bold">
                                                        {{ $item->status === 'pending'
                                                            ? 'Pending'
                                                            : ($item->status === 'approved'
                                                                ? 'Approved'
                                                                : ($item->status === 'cancelled'
                                                                    ? 'Cancelled'
                                                                    : ($item->status === 'completed'
                                                                        ? 'Completed'
                                                                        : ($item->status === 'query'
                                                                            ? 'Query'
                                                                            : 'Suspended')))) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                        onclick="downloadPDF({{ $item->id }})">
                                                        <i class="fa-solid fa-print"></i>
                                                    </a>
                                                    <a href="{{ route('edit-booking', $item->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                        onclick="setDeleteAction('{{ route('delete-booking', $item->id) }}')">
                                                        <i class="ki-duotone ki-trash fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                <h3>No Data Found</h3>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setDeleteAction(url) {
            document.getElementById('deleteForm').action = url;
            $('#deleteConfirmationModal').modal('show');
        }

        function closeModal() {
            $('#deleteConfirmationModal').modal('hide');
        }
    </script>
    <script>
        function downloadPDF(id) {
            // Send the booking ID to the backend
            fetch(`/admin/generate-report/${id}`, {
                    method: 'GET', // Use POST if preferred
                    headers: {
                        'Accept': 'application/pdf',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to generate PDF');
                    }
                    return response.blob(); // Convert the response to a Blob
                })
                .then(blob => {
                    const pdfURL = URL.createObjectURL(blob); // Create a Blob URL

                    // Open the PDF in a new tab
                    window.open(pdfURL, '_blank');

                    // Optional: Trigger download
                    const downloadLink = document.createElement('a');
                    downloadLink.href = pdfURL;
                    downloadLink.download = `booking_${bookingId}.pdf`; // Custom filename with ID
                    downloadLink.click();

                    // Revoke the Blob URL to free up memory
                    URL.revokeObjectURL(pdfURL);
                })
                .catch(error => console.error('Error generating PDF:', error));
        }
    </script>
@endsection
