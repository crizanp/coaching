@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('content')
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-plus-circle me-3"></i>Create Blog Post
        </h1>
        <div class="header-actions">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Posts
            </a>
        </div>
    </div>
</div>

<div class="admin-content">
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Main Content Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Content</h5>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   id="slug" name="slug" value="{{ old('slug') }}">
                            <small class="form-text text-muted">Leave blank to auto-generate from title</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="form-group mb-3">
                            <label for="excerpt" class="form-label">Excerpt *</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
                            <small class="form-text text-muted">Brief description for blog listing and meta description</small>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="20" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">SEO Settings</h5>
                    </div>
                    <div class="card-body">
                        <!-- Meta Title -->
                        <div class="form-group mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255">
                            <small class="form-text text-muted">Leave blank to use post title (recommended length: 50-60 characters)</small>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Meta Description -->
                        <div class="form-group mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                      id="meta_description" name="meta_description" rows="2" maxlength="160">{{ old('meta_description') }}</textarea>
                            <small class="form-text text-muted">Leave blank to use excerpt (recommended length: 150-160 characters)</small>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Meta Keywords -->
                        <div class="form-group mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                   id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            <small class="form-text text-muted">Separate keywords with commas</small>
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Publish Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <!-- Status -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_published" 
                                   name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Publish immediately
                            </label>
                        </div>

                        <!-- Published Date -->
                        <div class="form-group mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                   id="published_at" name="published_at" value="{{ old('published_at') }}">
                            <small class="form-text text-muted">Leave blank to use current time when publishing</small>
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Post
                            </button>
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Featured Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                   id="featured_image" name="featured_image" 
                                   accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp">
                            <small class="form-text text-muted">
                                Formats supportés: JPG, JPEG, PNG, GIF, WebP<br>
                                Taille recommandée: 1200x630px | Taille max: 5MB
                            </small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 10px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
    }

    .admin-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(255, 255, 255, 0.075);
        border-radius: 10px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }
</style>
@endpush

@push('scripts')
<!-- TinyMCE Editor -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_style: 'body { font-family: Poppins, Arial, sans-serif; font-size: 14px }',
        branding: false,
        promotion: false
    });

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function(e) {
        const title = e.target.value;
        const slug = title.toLowerCase()
                          .replace(/[^a-z0-9 -]/g, '')
                          .replace(/\s+/g, '-')
                          .replace(/-+/g, '-')
                          .trim('-');
        document.getElementById('slug').value = slug;
    });

    // Image preview
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush