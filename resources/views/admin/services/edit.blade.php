@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Edit Service') }}: {{ $service->getTranslation('name', 'fr') }}</h4>
                        <div>
                            <a href="{{ route('admin.services.show', $service) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Services
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.services.update', $service) }}">
                        @csrf
                        @method('PUT')

                        <!-- Service Names -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name_fr" class="form-label">{{ __('Service Name (French)') }} <span class="text-danger">*</span></label>
                                <input id="name_fr" type="text" class="form-control @error('name_fr') is-invalid @enderror" 
                                       name="name_fr" value="{{ old('name_fr', $service->getTranslation('name', 'fr')) }}" required>
                                @error('name_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name_en" class="form-label">{{ __('Service Name (English)') }} <span class="text-danger">*</span></label>
                                <input id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                       name="name_en" value="{{ old('name_en', $service->getTranslation('name', 'en')) }}" required>
                                @error('name_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Service Descriptions -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="description_fr" class="form-label">{{ __('Description (French)') }} <span class="text-danger">*</span></label>
                                <textarea id="description_fr" class="form-control @error('description_fr') is-invalid @enderror" 
                                          name="description_fr" rows="3" required>{{ old('description_fr', $service->getTranslation('description', 'fr')) }}</textarea>
                                @error('description_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="description_en" class="form-label">{{ __('Description (English)') }} <span class="text-danger">*</span></label>
                                <textarea id="description_en" class="form-control @error('description_en') is-invalid @enderror" 
                                          name="description_en" rows="3" required>{{ old('description_en', $service->getTranslation('description', 'en')) }}</textarea>
                                @error('description_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Service Content -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="content_fr" class="form-label">{{ __('Full Content (French)') }}</label>
                                <textarea id="content_fr" class="form-control @error('content_fr') is-invalid @enderror" 
                                          name="content_fr" rows="8">{{ old('content_fr', $service->getTranslation('content', 'fr')) }}</textarea>
                                @error('content_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="content_en" class="form-label">{{ __('Full Content (English)') }}</label>
                                <textarea id="content_en" class="form-control @error('content_en') is-invalid @enderror" 
                                          name="content_en" rows="8">{{ old('content_en', $service->getTranslation('content', 'en')) }}</textarea>
                                @error('content_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Benefits -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="benefits_fr" class="form-label">{{ __('Benefits (French)') }}</label>
                                <div id="benefits_fr_container">
                                    @php $benefits_fr = old('benefits_fr', $service->getTranslation('benefits', 'fr') ?? []); @endphp
                                    @if(empty($benefits_fr))
                                        <input type="text" class="form-control mb-2" name="benefits_fr[]" placeholder="Enter a benefit">
                                    @else
                                        @foreach($benefits_fr as $benefit)
                                            <input type="text" class="form-control mb-2" name="benefits_fr[]" value="{{ $benefit }}" placeholder="Enter a benefit">
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addBenefit('fr')">
                                    <i class="fas fa-plus"></i> Add Benefit
                                </button>
                            </div>
                            <div class="col-md-6">
                                <label for="benefits_en" class="form-label">{{ __('Benefits (English)') }}</label>
                                <div id="benefits_en_container">
                                    @php $benefits_en = old('benefits_en', $service->getTranslation('benefits', 'en') ?? []); @endphp
                                    @if(empty($benefits_en))
                                        <input type="text" class="form-control mb-2" name="benefits_en[]" placeholder="Enter a benefit">
                                    @else
                                        @foreach($benefits_en as $benefit)
                                            <input type="text" class="form-control mb-2" name="benefits_en[]" value="{{ $benefit }}" placeholder="Enter a benefit">
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addBenefit('en')">
                                    <i class="fas fa-plus"></i> Add Benefit
                                </button>
                            </div>
                        </div>

                        <!-- Session Format -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="session_format_fr" class="form-label">{{ __('Session Format (French)') }}</label>
                                <div id="session_format_fr_container">
                                    @php $session_format_fr = old('session_format_fr', $service->getTranslation('session_format', 'fr') ?? []); @endphp
                                    @if(empty($session_format_fr))
                                        <input type="text" class="form-control mb-2" name="session_format_fr[]" placeholder="Enter session format">
                                    @else
                                        @foreach($session_format_fr as $format)
                                            <input type="text" class="form-control mb-2" name="session_format_fr[]" value="{{ $format }}" placeholder="Enter session format">
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSessionFormat('fr')">
                                    <i class="fas fa-plus"></i> Add Format
                                </button>
                            </div>
                            <div class="col-md-6">
                                <label for="session_format_en" class="form-label">{{ __('Session Format (English)') }}</label>
                                <div id="session_format_en_container">
                                    @php $session_format_en = old('session_format_en', $service->getTranslation('session_format', 'en') ?? []); @endphp
                                    @if(empty($session_format_en))
                                        <input type="text" class="form-control mb-2" name="session_format_en[]" placeholder="Enter session format">
                                    @else
                                        @foreach($session_format_en as $format)
                                            <input type="text" class="form-control mb-2" name="session_format_en[]" value="{{ $format }}" placeholder="Enter session format">
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSessionFormat('en')">
                                    <i class="fas fa-plus"></i> Add Format
                                </button>
                            </div>
                        </div>

                        <!-- Pricing and Details -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="price_individual" class="form-label">{{ __('Individual Price (€)') }}</label>
                                <input id="price_individual" type="number" class="form-control @error('price_individual') is-invalid @enderror" 
                                       name="price_individual" value="{{ old('price_individual', $service->price_individual) }}" min="0" step="0.01">
                                @error('price_individual')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label">{{ __('Duration (minutes)') }}</label>
                                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" 
                                       name="duration" value="{{ old('duration', $service->duration) }}" min="1">
                                @error('duration')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label">{{ __('Sort Order') }}</label>
                                <input id="sort_order" type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" min="0">
                                @error('sort_order')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Icon and Status -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="icon" class="form-label">{{ __('Icon') }}</label>
                                <select id="icon" class="form-select @error('icon') is-invalid @enderror" name="icon">
                                    <option value="heart" {{ old('icon', $service->icon) == 'heart' ? 'selected' : '' }}>❤️ Heart</option>
                                    <option value="leaf" {{ old('icon', $service->icon) == 'leaf' ? 'selected' : '' }}>🍃 Leaf</option>
                                    <option value="moon" {{ old('icon', $service->icon) == 'moon' ? 'selected' : '' }}>🌙 Moon</option>
                                    <option value="brain" {{ old('icon', $service->icon) == 'brain' ? 'selected' : '' }}>🧠 Brain</option>
                                    <option value="lotus" {{ old('icon', $service->icon) == 'lotus' ? 'selected' : '' }}>🪷 Lotus</option>
                                    <option value="spa" {{ old('icon', $service->icon) == 'spa' ? 'selected' : '' }}>🧘 Spa</option>
                                </select>
                                @error('icon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Status') }}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        {{ __('Active') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Featured') }}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        {{ __('Featured Service') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.services.show', $service) }}" class="btn btn-secondary">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Update Service') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addBenefit(lang) {
    const container = document.getElementById(`benefits_${lang}_container`);
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.name = `benefits_${lang}[]`;
    input.placeholder = 'Enter a benefit';
    container.appendChild(input);
}

function addSessionFormat(lang) {
    const container = document.getElementById(`session_format_${lang}_container`);
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.name = `session_format_${lang}[]`;
    input.placeholder = 'Enter session format';
    container.appendChild(input);
}
</script>
@endsection