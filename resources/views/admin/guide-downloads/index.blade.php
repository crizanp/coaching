@extends('layouts.admin')

@section('title', 'Guide Downloads')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guide Downloads</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['approved'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['sent'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.guide-downloads.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.guide-downloads.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Downloads Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Guide Download Requests</h6>
            <div>
                <button type="button" class="btn btn-sm btn-success" onclick="bulkAction('approve')" id="bulk-approve" style="display: none;">
                    <i class="fas fa-check"></i> Approve Selected
                </button>
                <button type="button" class="btn btn-sm btn-danger" onclick="bulkAction('reject')" id="bulk-reject" style="display: none;">
                    <i class="fas fa-times"></i> Reject Selected
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($downloads->count() > 0)
            <form id="bulk-form" method="POST" action="{{ route('admin.guide-downloads.bulk-action') }}">
                @csrf
                <input type="hidden" name="action" id="bulk-action">
                
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Guide</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downloads as $download)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $download->id }}" class="select-item">
                                </td>
                                <td>{{ $download->name }}</td>
                                <td>{{ $download->email }}</td>
                                <td>{{ $download->guide_title }}</td>
                                <td>{!! $download->status_badge !!}</td>
                                <td>{{ $download->formatted_created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.guide-downloads.show', $download) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($download->status === 'pending')
                                    <form method="POST" action="{{ route('admin.guide-downloads.approve', $download) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this request?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    @if($download->status === 'approved')
                                    <form method="POST" action="{{ route('admin.guide-downloads.send', $download) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Send guide to this email?')">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.guide-downloads.destroy', $download) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this request?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            
            <div class="d-flex justify-content-center">
                {{ $downloads->appends(request()->query())->links() }}
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted">No guide download requests found.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Select all functionality
    $('#select-all').change(function() {
        $('.select-item').prop('checked', this.checked);
        toggleBulkButtons();
    });
    
    $('.select-item').change(function() {
        toggleBulkButtons();
    });
    
    function toggleBulkButtons() {
        const checkedItems = $('.select-item:checked').length;
        if (checkedItems > 0) {
            $('#bulk-approve, #bulk-reject').show();
        } else {
            $('#bulk-approve, #bulk-reject').hide();
        }
    }
});

function bulkAction(action) {
    if ($('.select-item:checked').length === 0) {
        alert('Please select at least one item.');
        return;
    }
    
    const message = action === 'approve' ? 'Approve selected requests?' : 'Reject selected requests?';
    if (confirm(message)) {
        $('#bulk-action').val(action);
        $('#bulk-form').submit();
    }
}
</script>
@endpush
@endsection