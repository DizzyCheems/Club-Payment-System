    @extends('layouts.main')

    @section('content')

    {{-- Success Flash Message --}}
    @if (Session::has('success'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <h1 class="app-page-title">Documents</h1>
                        <div class="app-card-body p-3 p-lg-4">

                            {{-- Search Bar --}}
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-6">
                                    <form id="searchForm" action="{{ route('doc.index') }}" method="GET">
                                        <div class="input-group">
                                            <input 
                                                type="text" 
                                                id="searchInput" 
                                                name="search" 
                                                class="form-control" 
                                                placeholder="Search files..." 
                                                value="{{ request()->input('search') }}"
                                            >
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                            @if(request()->input('search'))
                                                <a href="#" id="clearSearch" class="btn app-btn-secondary text-danger">Clear</a>
                                            @endif
                                        </div>
                                    </form>
                                    @if($files->isEmpty() && request()->input('search'))
                                        <p class="mt-2">No files found for "{{ request()->input('search') }}"</p>
                                    @endif
                                </div>

                                <div class="col-md-auto ms-auto">
                                    <button type="button" class="btn app-btn-primary" data-toggle="modal" data-target="#uploadModal">
                                        Upload File
                                    </button>
                                </div>
                            </div>

                            {{-- Documents Table --}}
                            <div class="app-card app-card-orders-table shadow-sm mb-4">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>File Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($files as $key => $file)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $file->file_name }}</td>
                                                        <td>
                                                            {{-- Download Button --}}
                                                            <form action="{{ route('file.download', $file->id) }}" method="GET" style="display:inline;">
                                                                <button type="submit" class="btn-sm app-btn-secondary">Download</button>
                                                            </form>

                                                            {{-- Preview Button - opens in new tab --}}
                                                            <a href="{{ route('file.preview', $file->id) }}" target="_blank" class="btn-sm app-btn-secondary">
                                                                Preview
                                                            </a>

                                                            {{-- Delete Button --}}
                                                            <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-sm app-btn-secondary app-btn-secondary-delete">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No documents uploaded yet.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div><!--//app-card-body-->
                    </div><!--//inner-->
                </div><!--//app-card-->

            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('fileupload.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" class="fw-bold">Choose File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn app-btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
   {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // SweetAlert for flash messages
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            // Clear Search Button
            const clearBtn = document.getElementById('clearSearch');
            if (clearBtn) {
                clearBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.getElementById('searchInput').value = '';
                    document.getElementById('searchForm').submit();
                });
            }

            // SweetAlert Delete Confirmation
            $(document).on('click', '.app-btn-secondary-delete', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won’t be able to undo this action.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>


    @endsection
