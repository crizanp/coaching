@extends('layouts.admin')

@section('page-title', 'Edit Blog Post')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Blog Post</h2>
            <p class="text-muted">Update and modify your blog article</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.blogs.index') }}" class="btn-admin btn-admin-outline">
                <i class="fas fa-arrow-left"></i>
                Back to Posts
            </a>
            <a href="{{ route('blog.show', ['locale' => 'en', 'blog' => $blog->slug]) }}" 
               class="btn-admin btn-admin-primary" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                View Post
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
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
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $blog->slug) }}">
                        <small class="form-text text-muted">Leave blank to auto-generate from title</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div class="form-group mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        <small class="form-text text-muted">Brief description of the post (optional, will be auto-generated if empty)</small>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Content *</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" 
                                  rows="15" required>{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search me-2"></i>
                            SEO Settings
                        </h3>
                    </div>
                    
                    <!-- Meta Description -->
                    <div class="form-group mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" name="meta_description" rows="2" maxlength="160">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        <small class="form-text text-muted">Leave blank to use excerpt (recommended length: 150-160 characters)</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                               id="meta_keywords" name="meta_keywords" 
                               value="{{ old('meta_keywords', is_array($blog->meta_keywords) ? implode(', ', $blog->meta_keywords) : '') }}">
                        <small class="form-text text-muted">Separate keywords with commas</small>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publish Settings -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-globe me-2"></i>
                            Publish Settings
                        </h3>
                    </div>
                    
                    <!-- Status -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_published" 
                               name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Published
                        </label>
                    </div>

                    <!-- Published Date -->
                    <div class="form-group mb-3">
                        <label for="published_at" class="form-label">Publish Date</label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" name="published_at" 
                               value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                        <small class="form-text text-muted">Leave blank to use current time when publishing</small>
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stats -->
                    <div class="mb-3">
                        <small class="text-muted">
                            <strong>Stats:</strong><br>
                            Views: {{ number_format($blog->views_count) }}<br>
                            Likes: {{ $blog->likes_count }}<br>
                            Dislikes: {{ $blog->dislikes_count }}<br>
                            Created: {{ $blog->created_at->format('M d, Y') }}
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-admin btn-admin-primary">
                            <i class="fas fa-save me-2"></i>Update Post
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn-admin btn-admin-outline">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
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
                    
                    <!-- Current Image -->
                    @if($blog->featured_image)
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label>
                            <div>
                                <img src="{{ Storage::url($blog->featured_image) }}" 
                                     alt="{{ $blog->title }}" class="img-fluid rounded">
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Image -->
                    <div class="form-group">
                        <label for="featured_image" class="form-label">
                            {{ $blog->featured_image ? 'Replace Image' : 'Upload Image' }}
                        </label>
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
    </form>
</div>
@endsection

@push('scripts')
<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
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

    // Image preview functionality
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush