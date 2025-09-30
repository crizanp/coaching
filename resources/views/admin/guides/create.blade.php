@extends('layouts.admin')

@section('title', 'Create Guide')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Guide</h1>
        <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to Guides
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Guide Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.guides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="title">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon Class *</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" name="icon" value="{{ old('icon', 'fa-book') }}" required>
                                    <small class="form-text text-muted">
                                        FontAwesome icon class (e.g., fa-book, fa-lungs, fa-brain)
                                    </small>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Benefits *</label>
                            <div id="benefits-container">
                                @if(old('benefits'))
                                    @foreach(old('benefits') as $index => $benefit)
                                        <div class="input-group mb-2 benefit-item">
                                            <input type="text" class="form-control @error('benefits.'.$index) is-invalid @enderror" 
                                                   name="benefits[]" value="{{ $benefit }}" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-benefit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            @error('benefits.'.$index)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 benefit-item">
                                        <input type="text" class="form-control" name="benefits[]" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-benefit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="add-benefit">
                                <i class="fas fa-plus"></i> Add Benefit
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="file">Guide File (PDF, DOC, DOCX)</label>
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror" 
                                   id="file" name="file" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Maximum file size: 10MB</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (visible to users)
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Guide
                            </button>
                            <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Icon Preview</h6>
                </div>
                <div class="card-body text-center">
                    <i id="icon-preview" class="fas fa-book fa-4x text-primary"></i>
                    <p class="mt-2 text-muted">Enter an icon class to see preview</p>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Popular Icons</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4 mb-3">
                            <i class="fas fa-book fa-2x text-primary cursor-pointer" data-icon="fa-book" title="fa-book"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <i class="fas fa-lungs fa-2x text-primary cursor-pointer" data-icon="fa-lungs" title="fa-lungs"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <i class="fas fa-brain fa-2x text-primary cursor-pointer" data-icon="fa-brain" title="fa-brain"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <i class="fas fa-seedling fa-2x text-primary cursor-pointer" data-icon="fa-seedling" title="fa-seedling"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <i class="fas fa-heart fa-2x text-primary cursor-pointer" data-icon="fa-heart" title="fa-heart"></i>
                        </div>
                        <div class="col-4 mb-3">
                            <i class="fas fa-leaf fa-2x text-primary cursor-pointer" data-icon="fa-leaf" title="fa-leaf"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cursor-pointer {
    cursor: pointer;
}
.cursor-pointer:hover {
    opacity: 0.7;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Icon preview
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');
    
    iconInput.addEventListener('input', function() {
        const iconClass = this.value || 'fa-book';
        iconPreview.className = `fas ${iconClass} fa-4x text-primary`;
    });
    
    // Icon selector
    document.querySelectorAll('[data-icon]').forEach(function(element) {
        element.addEventListener('click', function() {
            const iconClass = this.getAttribute('data-icon');
            iconInput.value = iconClass;
            iconPreview.className = `fas ${iconClass} fa-4x text-primary`;
        });
    });
    
    // Benefits management
    document.getElementById('add-benefit').addEventListener('click', function() {
        const container = document.getElementById('benefits-container');
        const newBenefit = document.createElement('div');
        newBenefit.className = 'input-group mb-2 benefit-item';
        newBenefit.innerHTML = `
            <input type="text" class="form-control" name="benefits[]" required>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-benefit">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newBenefit);
    });
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-benefit') || e.target.parentElement.classList.contains('remove-benefit')) {
            const benefitItem = e.target.closest('.benefit-item');
            const container = document.getElementById('benefits-container');
            if (container.children.length > 1) {
                benefitItem.remove();
            }
        }
    });
});
</script>
@endsection