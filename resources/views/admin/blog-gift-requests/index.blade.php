@extends('layouts.admin')

@section('page-title', 'Blog Gift Requests')

@section('content')
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-gift me-3"></i>Blog Gift Requests
        </h1>
    </div>
</div>

<div class="admin-content">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Requests</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['processed'] }}</div>
                <div class="stat-label">Processed</div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.blog-gift-requests.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search by name or email">
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="{{ \App\Models\BlogGiftRequest::STATUS_PENDING }}" {{ request('status') === \App\Models\BlogGiftRequest::STATUS_PENDING ? 'selected' : '' }}>Pending</option>
                        <option value="{{ \App\Models\BlogGiftRequest::STATUS_PROCESSED }}" {{ request('status') === \App\Models\BlogGiftRequest::STATUS_PROCESSED ? 'selected' : '' }}>Processed</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.blog-gift-requests.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($requests->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Requester</th>
                                <th>Contact</th>
                                <th>Blog Post</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $requestItem)
                                <tr>
                                    <td>
                                        <strong>{{ $requestItem->full_name }}</strong>
                                    </td>
                                    <td class="text-muted">
                                        <div><i class="fas fa-envelope me-2"></i>{{ $requestItem->email }}</div>
                                        <div><i class="fas fa-phone me-2"></i>{{ $requestItem->phone }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $requestItem->blog_title }}</div>
                                        <small class="text-muted">Locale: {{ strtoupper($requestItem->locale) }}</small>
                                    </td>
                                    <td>{!! $requestItem->status_badge !!}</td>
                                    <td><small class="text-muted">{{ $requestItem->formatted_created_at }}</small></td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.blog-gift-requests.show', $requestItem) }}" class="btn btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($requestItem->status === \App\Models\BlogGiftRequest::STATUS_PENDING)
                                                <form method="POST" action="{{ route('admin.blog-gift-requests.update', $requestItem) }}" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ \App\Models\BlogGiftRequest::STATUS_PROCESSED }}">
                                                    <button type="submit" class="btn btn-outline-success" title="Mark as processed">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.blog-gift-requests.update', $requestItem) }}" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="{{ \App\Models\BlogGiftRequest::STATUS_PENDING }}">
                                                    <button type="submit" class="btn btn-outline-warning" title="Mark as pending">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.blog-gift-requests.destroy', $requestItem) }}" class="d-inline" onsubmit="return confirm('Delete this request?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $requests->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No requests found</h5>
                    <p class="text-muted">Gift requests submitted from blog posts will appear here.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
