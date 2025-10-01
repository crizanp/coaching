@extends('layouts.admin')

@section('page-title', 'Events & Workshops')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Events & Workshops</h2>
            <p class="text-muted">Manage your workshops and events</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i>
            Create New Event
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-value">{{ $events->total() }}</div>
                <div class="stat-label">Total Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $events->where('status', 'active')->count() }}</div>
                <div class="stat-label">Active Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">{{ $events->where('status', 'upcoming')->count() }}</div>
                <div class="stat-label">Upcoming Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">{{ $events->sum('current_participants') }}</div>
                <div class="stat-label">Total Participants</div>
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
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="workshop" {{ request('type') === 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="practical" {{ request('type') === 'practical' ? 'selected' : '' }}>Practical</option>
                    <option value="online" {{ request('type') === 'online' ? 'selected' : '' }}>Online</option>
                    <option value="hybrid" {{ request('type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="btn-admin btn-admin-outline">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Events Table -->
    <div class="admin-table">
        <div class="table-header">
            <h3 class="card-title">Events List</h3>
            <div class="d-flex gap-2">
                <select class="form-control form-control-sm" id="bulkAction" style="width: auto;">
                    <option value="">Bulk Actions</option>
                    <option value="activate">Activate</option>
                    <option value="deactivate">Deactivate</option>
                    <option value="delete">Delete</option>
                </select>
                <button type="button" class="btn-admin btn-admin-outline btn-sm" id="applyBulk">Apply</button>
            </div>
        </div>

        @if($events->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Participants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>
                                <input type="checkbox" class="event-checkbox" value="{{ $event->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($event->featured_image)
                                        <img src="{{ asset('storage/' . $event->featured_image) }}" 
                                             alt="{{ $event->getTranslation('title', 'fr') }}"
                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-calendar-alt text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $event->getTranslation('title', 'fr') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($event->getTranslation('description', 'fr'), 50) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ ucfirst($event->type) }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ 
                                    $event->status === 'active' ? 'success' : 
                                    ($event->status === 'upcoming' ? 'warning' : 
                                    ($event->status === 'completed' ? 'info' : 'danger')) 
                                }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                @if($event->event_date)
                                    {{ $event->event_date->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong>{{ $event->current_participants }}</strong>
                                    @if($event->max_participants)
                                        / {{ $event->max_participants }}
                                    @endif
                                    <br>
                                    @if($event->max_participants)
                                        <small class="text-muted">
                                            {{ $event->available_spots }} spots left
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.events.show', $event) }}" 
                                       class="btn-admin btn-admin-outline btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}" 
                                       class="btn-admin btn-admin-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.events.toggle-status', $event) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn-admin btn-admin-{{ $event->is_active ? 'warning' : 'success' }} btn-sm"
                                                title="{{ $event->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="fas fa-{{ $event->is_active ? 'pause' : 'play' }}"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.events.duplicate', $event) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-admin btn-admin-info btn-sm" title="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" 
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
                {{ $events->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h4>No events found</h4>
                <p class="text-muted">Create your first event to get started.</p>
                <a href="{{ route('admin.events.create') }}" class="btn-admin btn-admin-primary">
                    <i class="fas fa-plus"></i>
                    Create Event
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.event-checkbox');
    
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk actions
    document.getElementById('applyBulk').addEventListener('click', function() {
        const action = document.getElementById('bulkAction').value;
        const selectedIds = Array.from(document.querySelectorAll('.event-checkbox:checked'))
                                .map(cb => cb.value);

        if (!action || selectedIds.length === 0) {
            alert('Please select an action and at least one event.');
            return;
        }

        if (confirm(`Are you sure you want to ${action} ${selectedIds.length} event(s)?`)) {
            // Implement bulk action logic here
            console.log('Bulk action:', action, 'IDs:', selectedIds);
        }
    });

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush