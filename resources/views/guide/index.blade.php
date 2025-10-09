@extends('layouts.frontend')

@section('title', __('messages.guides.title'))
@section('description', __('messages.guides.subtitle'))

@section('content')
<!-- Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="fade-in">
                    <h1 class="section-title">{{ __('messages.guides.title') }}</h1>
                    <p class="lead mb-4">{{ __('messages.guides.subtitle') }}</p>
                    <div class="hero-features">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>{{ __('messages.guides.professional_techniques') }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>{{ __('messages.guides.easy_instructions') }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>{{ __('messages.guides.immediate_application') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fade-in">
                    <div class="guide-hero-image">
                        <img src="{{ asset('images/assets/SSJchrysalis.png') }}" 
                             alt="{{ __('Free Wellness Guides') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Available Guides Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <div class="fade-in">
                    <h2 class="section-title">{{ __('messages.guides.choose') }}</h2>
                    <p class="lead">{{ __('messages.guides.select_guide') }}</p>
                </div>
            </div>
        </div>
        
        <div class="row" id="guides-container">
            <!-- Guides will be loaded dynamically -->
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">{{ __('messages.guides.loading') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section-padding" style="background: #F8E8EA;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <div class="fade-in">
                    <h2 class="section-title">{{ __('messages.guides.how_it_works') }}</h2>
                    <p class="lead">{{ __('messages.guides.how_subtitle') }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="how-it-works-step text-center">
                    <div class="step-icon">
                        <i class="fas fa-mouse-pointer"></i>
                        <span class="step-number">1</span>
                    </div>
                    <h4>{{ __('messages.guides.step1.title') }}</h4>
                    <p>{{ __('messages.guides.step1.desc') }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="how-it-works-step text-center">
                    <div class="step-icon">
                        <i class="fas fa-edit"></i>
                        <span class="step-number">2</span>
                    </div>
                    <h4>{{ __('messages.guides.step2.title') }}</h4>
                    <p>{{ __('messages.guides.step2.desc') }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="how-it-works-step text-center">
                    <div class="step-icon">
                        <i class="fas fa-envelope"></i>
                        <span class="step-number">3</span>
                    </div>
                    <h4>{{ __('messages.guides.step3.title') }}</h4>
                    <p>{{ __('messages.guides.step3.desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalTitle">{{ __('messages.guides.download_modal_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="downloadForm">
                    @csrf
                    <input type="hidden" id="guide_slug" name="guide_slug">
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div id="guide-preview">
                                <!-- Guide preview will be inserted here -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">{{ __('messages.guides.your_info') }}</h6>
                            
                            <div class="form-group">
                                <label for="name">{{ __('messages.guides.full_name') }} *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">{{ __('messages.guides.email') }} *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">{{ __('messages.guides.phone') }} ({{ __('messages.guides.optional') }})</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        {{ __('messages.guides.privacy_agree') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        {{ __('Your request will be reviewed and the guide will be sent to your email within 24 hours.') }}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="submitDownload">
                    <i class="fas fa-download me-2"></i>{{ __('Request Guide') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .guide-hero-image {
        text-align: center;
    }
    
    .guide-hero-image img {
        max-width: 300px;
        height: auto;
    }
    
    .guide-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: 1px solid #e0e0e0;
    }
    
    .guide-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .guide-icon {
        width: 80px;
        height: 80px;
        background: var(--light-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary-pink);
        margin: 0 auto 20px;
    }
    
    .guide-benefits {
        list-style: none;
        padding: 0;
    }
    
    .guide-benefits li {
        padding: 5px 0;
        padding-left: 25px;
        position: relative;
    }
    
    .guide-benefits li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--primary-pink);
        font-weight: bold;
    }
    
    .how-it-works-step {
        position: relative;
    }
    
    .step-icon {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary-pink);
        margin: 0 auto 20px;
        position: relative;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .step-number {
        position: absolute;
        top: -10px;
        right: -10px;
        background: var(--primary-pink);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: bold;
    }
    
    .hero-features {
        margin-top: 20px;
    }
    
    .hero-features .fas {
        font-size: 1.2rem;
    }
    
    #guide-preview {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }
    
    .alert {
        border: none;
        border-radius: 10px;
    }
    
    .btn-download {
        background: var(--primary-pink);
        border: var(--primary-pink);
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }
    
    .btn-download:hover {
        background: #d63384;
        border-color: #d63384;
        color: white;
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    loadGuides();
    
    $('#submitDownload').click(function() {
        submitDownloadForm();
    });
});

function loadGuides() {
    console.log('Loading guides from:', '{{ route("guides.list", app()->getLocale()) }}');
    $.get('{{ route("guides.list", app()->getLocale()) }}', function(guides) {
        console.log('Guides loaded successfully:', guides);
        displayGuides(guides);
    }).fail(function(xhr, status, error) {
        console.error('Failed to load guides:', xhr, status, error);
        $('#guides-container').html('<div class="col-12 text-center"><p class="text-muted">{{ __("messages.guides.error_loading") }}</p></div>');
    });
}

function displayGuides(guides) {
    let html = '';
    guides.forEach(function(guide) {
        html += `
            <div class="col-lg-4 mb-4">
                <div class="guide-card">
                    <div class="guide-icon">
                        <i class="fas ${guide.icon}"></i>
                    </div>
                    <h4 class="text-center mb-3">${guide.title}</h4>
                    <p class="text-muted mb-4">${guide.description}</p>
                    <ul class="guide-benefits mb-4">
                        ${guide.benefits.map(benefit => `<li>${benefit}</li>`).join('')}
                    </ul>
                    <div class="text-center">
                        <button class="btn btn-download" onclick="openDownloadModal('${guide.id}', '${guide.title}', '${guide.description}', ${JSON.stringify(guide.benefits).replace(/"/g, '&quot;')})">
                            <i class="fas fa-download me-2"></i>{{ __('messages.guides.download_free') }}
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    $('#guides-container').html(html);
}

function openDownloadModal(guideId, title, description, benefits) {
    $('#downloadModalTitle').text('{{ __("messages.guides.download") }}: ' + title);
    $('#guide_slug').val(guideId);
    
    let previewHtml = `
        <h6>${title}</h6>
        <p class="text-muted">${description}</p>
        <h6 class="mt-3">{{ __("messages.guides.what_youll_get") }}:</h6>
        <ul class="list-unstyled">
            ${benefits.map(benefit => `<li><i class="fas fa-check text-success me-2"></i>${benefit}</li>`).join('')}
        </ul>
    `;
    
    $('#guide-preview').html(previewHtml);
    $('#downloadForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    
    $('#downloadModal').modal('show');
}

function submitDownloadForm() {
    const formData = new FormData($('#downloadForm')[0]);
    
    $('#submitDownload').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>{{ __("messages.guides.submitting") }}');
    
    $.ajax({
        url: '{{ route("guide.download", app()->getLocale()) }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                $('#downloadModal').modal('hide');
                
                // Show success message
                $('body').append(`
                    <div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 100px; right: 20px; z-index: 9999;">
                        <strong>{{ __("messages.guides.success") }}</strong> ${response.message}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                `);
                
                // Auto-hide after 5 seconds
                setTimeout(function() {
                    $('.alert-success').fadeOut();
                }, 5000);
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                
                for (let field in errors) {
                    $(`#${field}`).addClass('is-invalid');
                    $(`#${field}`).siblings('.invalid-feedback').text(errors[field][0]);
                }
            } else if (xhr.status === 429) {
                // Rate limiting
                alert(xhr.responseJSON.message);
            } else {
                alert('{{ __("messages.guides.error_occurred") }}');
            }
        },
        complete: function() {
            $('#submitDownload').prop('disabled', false).html('<i class="fas fa-download me-2"></i>{{ __("messages.guides.request_guide") }}');
        }
    });
}
</script>
@endpush
@endsection