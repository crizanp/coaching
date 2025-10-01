@extends('layouts.admin')

@section('page-title', 'Edit Event')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Event</h2>
            <p class="text-muted">Update event details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.events.show', $event) }}" class="btn-admin btn-admin-outline">
                <i class="fas fa-eye"></i>
                View Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn-admin btn-admin-outline">
                <i class="fas fa-arrow-left"></i>
                Back to Events
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.events.update', $event) }}" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Basic Information -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle me-2"></i>
                            Basic Information
                        </h3>
                    </div>
                    
                    <!-- Title -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Title (French) *</label>
                            <input type="text" name="title[fr]" class="form-control @error('title.fr') is-invalid @enderror" 
                                   value="{{ old('title.fr', $event->getTranslation('title', 'fr')) }}" required>
                            @error('title.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Title (English)</label>
                            <input type="text" name="title[en]" class="form-control @error('title.en') is-invalid @enderror" 
                                   value="{{ old('title.en', $event->getTranslation('title', 'en')) }}">
                            @error('title.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Description (French) *</label>
                            <textarea name="description[fr]" rows="4" class="form-control @error('description.fr') is-invalid @enderror" required>{{ old('description.fr', $event->getTranslation('description', 'fr')) }}</textarea>
                            @error('description.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description (English)</label>
                            <textarea name="description[en]" rows="4" class="form-control @error('description.en') is-invalid @enderror">{{ old('description.en', $event->getTranslation('description', 'en')) }}</textarea>
                            @error('description.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Content (French) *</label>
                            <textarea name="content[fr]" rows="6" class="form-control @error('content.fr') is-invalid @enderror" required>{{ old('content.fr', $event->getTranslation('content', 'fr')) }}</textarea>
                            @error('content.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Content (English)</label>
                            <textarea name="content[en]" rows="6" class="form-control @error('content.en') is-invalid @enderror">{{ old('content.en', $event->getTranslation('content', 'en')) }}</textarea>
                            @error('content.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="workshop" {{ old('type', $event->type) === 'workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="practical" {{ old('type', $event->type) === 'practical' ? 'selected' : '' }}>Practical</option>
                                <option value="online" {{ old('type', $event->type) === 'online' ? 'selected' : '' }}>Online</option>
                                <option value="hybrid" {{ old('type', $event->type) === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $event->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="active" {{ old('status', $event->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" 
                                   value="{{ old('duration', $event->duration) }}" placeholder="e.g., 2 hours, variable">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Price (€)</label>
                            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $event->price) }}" placeholder="Leave empty for estimate">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Leave empty to show "on estimate"</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Max Participants</label>
                            <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror" 
                                   value="{{ old('max_participants', $event->max_participants) }}" placeholder="Leave empty for unlimited">
                            @error('max_participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', $event->sort_order) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Event Date</label>
                            <input type="datetime-local" name="event_date" class="form-control @error('event_date') is-invalid @enderror" 
                                   value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : '') }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Registration Deadline</label>
                            <input type="datetime-local" name="registration_deadline" class="form-control @error('registration_deadline') is-invalid @enderror" 
                                   value="{{ old('registration_deadline', $event->registration_deadline ? $event->registration_deadline->format('Y-m-d\TH:i') : '') }}">
                            @error('registration_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Location (French)</label>
                            <input type="text" name="location[fr]" class="form-control @error('location.fr') is-invalid @enderror" 
                                   value="{{ old('location.fr', $event->getTranslation('location', 'fr')) }}" placeholder="e.g., Martinique">
                            @error('location.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location (English)</label>
                            <input type="text" name="location[en]" class="form-control @error('location.en') is-invalid @enderror" 
                                   value="{{ old('location.en', $event->getTranslation('location', 'en')) }}" placeholder="e.g., Martinique">
                            @error('location.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search me-2"></i>
                            SEO Settings
                        </h3>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">SEO Title (French)</label>
                            <input type="text" name="seo_title[fr]" class="form-control @error('seo_title.fr') is-invalid @enderror" 
                                   value="{{ old('seo_title.fr', $event->getTranslation('seo_title', 'fr')) }}">
                            @error('seo_title.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SEO Title (English)</label>
                            <input type="text" name="seo_title[en]" class="form-control @error('seo_title.en') is-invalid @enderror" 
                                   value="{{ old('seo_title.en', $event->getTranslation('seo_title', 'en')) }}">
                            @error('seo_title.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">SEO Description (French)</label>
                            <textarea name="seo_description[fr]" rows="3" class="form-control @error('seo_description.fr') is-invalid @enderror">{{ old('seo_description.fr', $event->getTranslation('seo_description', 'fr')) }}</textarea>
                            @error('seo_description.fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SEO Description (English)</label>
                            <textarea name="seo_description[en]" rows="3" class="form-control @error('seo_description.en') is-invalid @enderror">{{ old('seo_description.en', $event->getTranslation('seo_description', 'en')) }}</textarea>
                            @error('seo_description.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Event Statistics -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar me-2"></i>
                            Event Statistics
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
                </div>

                <!-- Featured Image -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-image me-2"></i>
                            Featured Image
                        </h3>
                    </div>

                    <div class="text-center">
                        @if($event->featured_image)
                            <img src="{{ asset('storage/' . $event->featured_image) }}" 
                                 alt="Current image" class="img-fluid rounded mb-3" style="max-height: 200px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                    </div>
                </div>

                <!-- Settings -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-cog me-2"></i>
                            Settings
                        </h3>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                               {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured"
                               {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Featured
                        </label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="allow_registration" value="1" class="form-check-input" id="allow_registration"
                               {{ old('allow_registration', $event->allow_registration) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allow_registration">
                            Allow Registration
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="admin-card">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-admin btn-admin-primary">
                            <i class="fas fa-save"></i>
                            Update Event
                        </button>
                        
                        <a href="{{ route('admin.events.show', $event) }}" class="btn-admin btn-admin-outline">
                            <i class="fas fa-eye"></i>
                            View Event
                        </a>
                        
                        <a href="{{ route('admin.events.index') }}" class="btn-admin btn-admin-outline">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection