@extends('layouts.admin')

@section('page-title', 'Blog Posts')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Blog Posts</h2>
            <p class="text-muted">Manage your blog posts and articles</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i>
            Create New Post
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-value">{{ $blogs->total() }}</div>
                <div class="stat-label">Total Posts</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $blogs->where('is_published', true)->count() }}</div>
                <div class="stat-label">Published Posts</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-pencil-alt"></i>
                </div>
                <div class="stat-value">{{ $blogs->where('is_published', false)->count() }}</div>
                <div class="stat-label">Draft Posts</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-value">{{ number_format($blogs->sum('views_count')) }}</div>
                <div class="stat-label">Total Views</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card mb-4">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <!-- Add categories here if you have them -->
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn-admin btn-admin-outline">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Blog Posts Table -->
    <div class="admin-table">
        <div class="table-header">
            <h3 class="card-title">Blog Posts List</h3>
            <div class="d-flex gap-2">
                <select class="form-control form-control-sm" id="bulkAction" style="width: auto;">
                    <option value="">Bulk Actions</option>
                    <option value="publish">Publish</option>
                    <option value="unpublish">Unpublish</option>
                    <option value="delete">Delete</option>
                </select>
                <button type="button" class="btn-admin btn-admin-outline btn-sm" id="applyBulk">Apply</button>
            </div>
        </div>

        @if($blogs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Post</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                        <tr>
                            <td>
                                <input type="checkbox" class="blog-checkbox" value="{{ $blog->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($blog->featured_image)
                                        <img src="{{ Storage::url($blog->featured_image) }}"
                                             alt="{{ $blog->title }}"
                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-blog text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $blog->title }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($blog->excerpt, 50) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $blog->is_published ? 'success' : 'warning' }}">
                                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                @if($blog->published_at)
                                    {{ $blog->published_at->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-muted">Not published</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong>{{ number_format($blog->views_count) }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-thumbs-up"></i> {{ $blog->likes_count }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.blogs.show', $blog) }}"
                                       class="btn-admin btn-admin-outline btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                       class="btn-admin btn-admin-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.blogs.toggle-publish', $blog) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="btn-admin btn-admin-{{ $blog->is_published ? 'warning' : 'success' }} btn-sm"
                                                title="{{ $blog->is_published ? 'Unpublish' : 'Publish' }}">
                                            <i class="fas fa-{{ $blog->is_published ? 'eye-slash' : 'globe' }}"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}"
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm" title="Delete">
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                <h4>No blog posts found</h4>
                <p class="text-muted">Get started by creating your first blog post.</p>
                <a href="{{ route('admin.blogs.create') }}" class="btn-admin btn-admin-primary">
                    <i class="fas fa-plus"></i>
                    Create Post
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.blog-checkbox');

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }

    const bulkButton = document.getElementById('applyBulk');
    if (bulkButton) {
        bulkButton.addEventListener('click', function() {
            const action = document.getElementById('bulkAction').value;
            const selectedIds = Array.from(document.querySelectorAll('.blog-checkbox:checked'))
                                    .map(cb => cb.value);

            if (!action || selectedIds.length === 0) {
                alert('Please select an action and at least one blog post.');
                return;
            }

            if (confirm(`Are you sure you want to ${action} ${selectedIds.length} post(s)?`)) {
                console.log('Bulk action:', action, 'IDs:', selectedIds);
            }
        });
    }

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this blog post? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush