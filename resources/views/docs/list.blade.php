@extends('layouts.main')
@section('content')

<!-- Start-Body -->
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                <h1 class="app-page-title">Documents</h1>
                    <div class="app-card-body p-3 p-lg-4">

                    <div class="container-xl">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form id="searchForm" action="{{ route('doc.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search files..." value="{{ request()->input('search') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    @if(request()->input('search'))
                                        <a href="#" id="clearSearch" class="btn btn-link text-danger">Clear</a>
                                    @endif
                                </div>
                            </form>
                            @if($files->isEmpty() && request()->input('search'))
                                <p>No files found for "{{ request()->input('search') }}"</p>
                            @endif
                        </div>
                    </div>
                </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $key => $file)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $file->file_name }}</td>                                     
                                        <td>
                                        <div class="d-inline">
                                        <form action="{{ route('file.download', $file->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-success">Download</button>
                                        </form> 
                                        
                                        <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                                        </form>

                                        <form action="{{ route('file.preview', $file->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-success">Preview</button>
                                        </form>
                                    </td>
                                    </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-actions center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                                Upload File
                            </button>
                        </div>

                    </div><!-- //app-card-body -->
                </div><!-- //inner -->
            </div><!-- //app-card -->

        </div><!-- //container-xl -->
    </div><!-- //app-content -->
</div><!-- //app-wrapper -->

<!-- BEGIN: Page JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
<!-- END: Page JS -->

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('fileupload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file"></label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Upload Modal -->

<script>
    document.getElementById('clearSearch').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        document.getElementById('searchInput').value = '';
        document.getElementById('searchForm').submit();
    });
</script>

@endsection
