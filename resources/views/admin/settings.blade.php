@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Site Settings') }}</h4>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf

                        <!-- Site Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="site_name_fr" class="form-label">{{ __('Site Name (French)') }}</label>
                                <input id="site_name_fr" type="text" class="form-control @error('site_name_fr') is-invalid @enderror" 
                                       name="site_name_fr" value="{{ old('site_name_fr', $settings['site_name']['fr'] ?? '') }}" required>
                                @error('site_name_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="site_name_en" class="form-label">{{ __('Site Name (English)') }}</label>
                                <input id="site_name_en" type="text" class="form-control @error('site_name_en') is-invalid @enderror" 
                                       name="site_name_en" value="{{ old('site_name_en', $settings['site_name']['en'] ?? '') }}" required>
                                @error('site_name_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Site Tagline -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="site_tagline_fr" class="form-label">{{ __('Site Tagline (French)') }}</label>
                                <input id="site_tagline_fr" type="text" class="form-control @error('site_tagline_fr') is-invalid @enderror" 
                                       name="site_tagline_fr" value="{{ old('site_tagline_fr', $settings['site_tagline']['fr'] ?? '') }}" required>
                                @error('site_tagline_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="site_tagline_en" class="form-label">{{ __('Site Tagline (English)') }}</label>
                                <input id="site_tagline_en" type="text" class="form-control @error('site_tagline_en') is-invalid @enderror" 
                                       name="site_tagline_en" value="{{ old('site_tagline_en', $settings['site_tagline']['en'] ?? '') }}" required>
                                @error('site_tagline_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <h5 class="mt-4 mb-3">Contact Information</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_email" class="form-label">{{ __('Contact Email') }}</label>
                                <input id="contact_email" type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                       name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                                @error('contact_email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_phone" class="form-label">{{ __('Contact Phone') }}</label>
                                <input id="contact_phone" type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                       name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                                @error('contact_phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="address_fr" class="form-label">{{ __('Address (French)') }}</label>
                                <textarea id="address_fr" class="form-control @error('address_fr') is-invalid @enderror" 
                                          name="address_fr" rows="3">{{ old('address_fr', $settings['address']['fr'] ?? '') }}</textarea>
                                @error('address_fr')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address_en" class="form-label">{{ __('Address (English)') }}</label>
                                <textarea id="address_en" class="form-control @error('address_en') is-invalid @enderror" 
                                          name="address_en" rows="3">{{ old('address_en', $settings['address']['en'] ?? '') }}</textarea>
                                @error('address_en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Social Media -->
                        <h5 class="mt-4 mb-3">Social Media</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="social_facebook" class="form-label">{{ __('Facebook URL') }}</label>
                                <input id="social_facebook" type="url" class="form-control @error('social_facebook') is-invalid @enderror" 
                                       name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}">
                                @error('social_facebook')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="social_instagram" class="form-label">{{ __('Instagram URL') }}</label>
                                <input id="social_instagram" type="url" class="form-control @error('social_instagram') is-invalid @enderror" 
                                       name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}">
                                @error('social_instagram')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Save Settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection