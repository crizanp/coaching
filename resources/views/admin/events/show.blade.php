@extends('layouts.admin')

@section('page-title', $event->title)

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">{{ $event->title }}</h2>
            <p class="text-muted">
                <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'upcoming' ? 'primary' : ($event->status === 'completed' ? 'secondary' : ($event->status === 'cancelled' ? 'danger' : 'warning'))) }}">
                    {{ ucfirst($event->status) }}
                </span>
                •
                {{ $event->type ? ucfirst($event->type) : 'Workshop' }}
                @if($event->event_date)
                    • {{ $event->event_date->format('M d, Y') }}
                @endif
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn-admin btn-admin-primary">
                <i class="fas fa-edit"></i>
                Edit Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn-admin btn-admin-outline">
                <i class="fas fa-arrow-left"></i>
                Back to Events
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Event Overview -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Event Overview
                    </h3>
                </div>

                @if($event->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $event->featured_image) }}" 
                             alt="{{ $event->title }}" class="img-fluid rounded">
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Description (French)</h5>
                        <p>{{ $event->getTranslation('description', 'fr') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (English)</h5>
                        <p>{{ $event->getTranslation('description', 'en') ?: 'Not available' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Content (French)</h5>
                        <div class="content-preview">
                            {!! nl2br(e($event->getTranslation('content', 'fr'))) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Content (English)</h5>
                        <div class="content-preview">
                            {!! $event->getTranslation('content', 'en') ? nl2br(e($event->getTranslation('content', 'en'))) : 'Not available' !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Event Details
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold">Type:</td>
                                <td>{{ $event->type ? ucfirst($event->type) : 'Workshop' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Duration:</td>
                                <td>{{ $event->duration ?: 'Variable' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Price:</td>
                                <td>
                                    @if($event->price)
                                        €{{ number_format((float)$event->price, 2) }}
                                    @else
                                        {{ __('messages.events.tba') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Max Participants:</td>
                                <td>{{ $event->max_participants ?: 'Unlimited' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold">Event Date:</td>
                                <td>{{ $event->event_date ? $event->event_date->format('M d, Y H:i') : 'Not set' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Registration Deadline:</td>
                                <td>{{ $event->registration_deadline ? $event->registration_deadline->format('M d, Y H:i') : 'Not set' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Location (FR):</td>
                                <td>{{ $event->getTranslation('location', 'fr') ?: 'Not specified' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Location (EN):</td>
                                <td>{{ $event->getTranslation('location', 'en') ?: 'Not specified' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Applications -->
            <div class="admin-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        Applications ({{ $event->applications()->count() }})
                    </h3>
                    @if($event->applications()->count() > 0)
                        <a href="{{ route('admin.event-applications.index', ['event' => $event->id]) }}" class="btn btn-sm btn-primary">
                            Manage Applications
                        </a>
                    @endif
                </div>

                @if($event->applications()->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Applied</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->applications()->latest()->limit(10)->get() as $application)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $application->name }}</div>
                                        </td>
                                        <td>{{ $application->email }}</td>
                                        <td>{{ $application->phone ?: '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : ($application->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $application->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.event-applications.show', $application) }}" 
                                                   class="btn btn-outline-primary btn-sm" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.event-applications.destroy', $application) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
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
                    
                    @if($event->applications()->count() > 10)
                        <div class="text-center pt-3">
                            <a href="{{ route('admin.event-applications.index', ['event' => $event->id]) }}" class="btn btn-link">
                                View all {{ $event->applications()->count() }} applications →
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users text-muted fa-3x mb-3"></i>
                        <p class="text-muted">No applications yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Statistics -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistics
                    </h3>
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value">{{ $event->applications()->count() }}</div>
                        <div class="stat-label">Total Applications</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $event->applications()->where('status', 'confirmed')->count() }}</div>
                        <div class="stat-label">Confirmed</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $event->applications()->where('status', 'pending')->count() }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $event->applications()->where('status', 'cancelled')->count() }}</div>
                        <div class="stat-label">Cancelled</div>
                    </div>
                </div>

                @if($event->max_participants)
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Capacity</span>
                            <span class="text-muted">
                                {{ $event->applications()->where('status', 'confirmed')->count() }}/{{ $event->max_participants }}
                            </span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ ($event->applications()->where('status', 'confirmed')->count() / $event->max_participants) * 100 }}%">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Event Settings -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog me-2"></i>
                        Settings
                    </h3>
                </div>

                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Active</span>
                        <span class="badge bg-{{ $event->is_active ? 'success' : 'secondary' }}">
                            {{ $event->is_active ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Featured</span>
                        <span class="badge bg-{{ $event->is_featured ? 'primary' : 'secondary' }}">
                            {{ $event->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Allow Registration</span>
                        <span class="badge bg-{{ $event->allow_registration ? 'success' : 'danger' }}">
                            {{ $event->allow_registration ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Sort Order</span>
                        <span class="badge bg-light text-dark">{{ $event->sort_order }}</span>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            @if($event->getTranslation('seo_title', 'fr') || $event->getTranslation('seo_description', 'fr'))
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search me-2"></i>
                            SEO Information
                        </h3>
                    </div>

                    @if($event->getTranslation('seo_title', 'fr'))
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Title (French)</label>
                            <p class="text-muted">{{ $event->getTranslation('seo_title', 'fr') }}</p>
                        </div>
                    @endif

                    @if($event->getTranslation('seo_title', 'en'))
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Title (English)</label>
                            <p class="text-muted">{{ $event->getTranslation('seo_title', 'en') }}</p>
                        </div>
                    @endif

                    @if($event->getTranslation('seo_description', 'fr'))
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Description (French)</label>
                            <p class="text-muted">{{ $event->getTranslation('seo_description', 'fr') }}</p>
                        </div>
                    @endif

                    @if($event->getTranslation('seo_description', 'en'))
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Description (English)</label>
                            <p class="text-muted">{{ $event->getTranslation('seo_description', 'en') }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h3>
                </div>

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('admin.events.toggle-status', $event) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-admin btn-admin-outline w-100">
                            <i class="fas fa-toggle-{{ $event->is_active ? 'off' : 'on' }}"></i>
                            {{ $event->is_active ? 'Deactivate' : 'Activate' }} Event
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.events.duplicate', $event) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-admin btn-admin-outline w-100">
                            <i class="fas fa-copy"></i>
                            Duplicate Event
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin btn-admin-danger w-100">
                            <i class="fas fa-trash"></i>
                            Delete Event
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
.content-preview {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    max-height: 200px;
    overflow-y: auto;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    color: var(--primary-color);
}

.stat-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-top: 0.25rem;
}
</style>
@endpush