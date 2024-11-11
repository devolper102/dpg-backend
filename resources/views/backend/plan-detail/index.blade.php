@extends('admin-includes.master')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Plan Details</h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('add-plan-detail') }}" class="btn btn-sm fw-bold btn-primary">Add New</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <!-- Confirmation Modal -->
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
                        Are you sure you want to delete this plan details?
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
                            <span class="card-label fw-bold fs-3 mb-1">All Plan Details</span>
                        </h3>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="min-w-40px">Sr#</th>
                                        <th class="min-w-125px">Website</th>
                                        <th class="min-w-125px">Category</th>
                                        <th class="min-w-125px">Plan</th>
                                        <th class="min-w-125px">Subscription</th>
                                        <th class="min-w-125px">Status</th>
                                        <th class="min-w-125px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($plainDetails))
                                        @foreach ($plainDetails as $item)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->website->name }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->category->name }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->plan->name }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->subscription->name }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }} fs-7 fw-bold">{{ $item->status == '1' ? 'Active' : 'Bloked' }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('edit-plan-detail', $item->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="ki-duotone ki-pencil fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </a>
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                        onclick="setDeleteAction('{{ route('delete-plan-detail', $item->id) }}')">
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
            // Set the action of the form to the delete URL
            document.getElementById('deleteForm').action = url;
            // Show the confirmation modal
            $('#deleteConfirmationModal').modal('show');
        }
        function closeModal() {
            // Close the modal using Bootstrap's modal method
            $('#deleteConfirmationModal').modal('hide');
        }
    </script>
@endsection
