@extends('layouts.admin')

@section('page-title', 'Blog Gift Request Details')

@section('content')
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-gift me-3"></i>Request from {{ $blogGiftRequest->full_name }}
        </h1>
        <div class="header-actions">
            <a href="{{ route('admin.blog-gift-requests.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Back to list
            </a>
            <a href="{{ url($blogGiftRequest->locale . '/blog/' . $blogGiftRequest->blog_slug) }}" target="_blank" class="btn btn-light">
                <i class="fas fa-external-link-alt me-2"></i>View blog post
            </a>
        </div>
    </div>
</div>

<div class="admin-content">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">Contact Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">First name</span>
                                <span class="info-value">{{ $blogGiftRequest->first_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Last name</span>
                                <span class="info-value">{{ $blogGiftRequest->last_name }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Email</span>
                                <a href="mailto:{{ $blogGiftRequest->email }}" class="info-value">
                                    {{ $blogGiftRequest->email }}
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Phone</span>
                                <a href="tel:{{ $blogGiftRequest->phone }}" class="info-value">
                                    {{ $blogGiftRequest->phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="card-title mb-3">Blog Post</h5>
                    <p class="mb-1 fw-semibold">{{ $blogGiftRequest->blog_title }}</p>
                    <p class="text-muted mb-0">Submitted from locale: <strong>{{ strtoupper($blogGiftRequest->locale) }}</strong></p>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">Status & Notes</h5>
                    <div class="mb-3">
                        <div class="info-block mb-2">
                            <span class="info-label">Current status</span>
                            <span class="info-value">{!! $blogGiftRequest->status_badge !!}</span>
                        </div>
                        <div class="info-block">
                            <span class="info-label">Submitted at</span>
                            <span class="info-value">{{ $blogGiftRequest->formatted_created_at }}</span>
                        </div>
                        @if($blogGiftRequest->processed_at)
                            <div class="info-block">
                                <span class="info-label">Processed at</span>
                                <span class="info-value">{{ $blogGiftRequest->processed_at->format('d/m/Y H:i') }}</span>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('admin.blog-gift-requests.update', $blogGiftRequest) }}" class="d-grid gap-3">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="{{ \App\Models\BlogGiftRequest::STATUS_PENDING }}" {{ $blogGiftRequest->status === \App\Models\BlogGiftRequest::STATUS_PENDING ? 'selected' : '' }}>Pending</option>
                                <option value="{{ \App\Models\BlogGiftRequest::STATUS_PROCESSED }}" {{ $blogGiftRequest->status === \App\Models\BlogGiftRequest::STATUS_PROCESSED ? 'selected' : '' }}>Processed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="admin_notes" class="form-label">Admin notes</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="Add a follow-up note or summary">{{ old('admin_notes', $blogGiftRequest->admin_notes) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save changes
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.blog-gift-requests.destroy', $blogGiftRequest) }}" class="mt-4" onsubmit="return confirm('Delete this request? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .info-block {
        display: flex;
        flex-direction: column;
    }
    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }
    .info-value {
        font-weight: 600;
        color: var(--admin-text);
    }
</style>
@endpush
