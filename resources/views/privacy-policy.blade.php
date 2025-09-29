@extends('layouts.frontend')

@section('title', __('messages.privacy.page.title'))
@section('description', __('messages.privacy.page.description'))

@section('content')
<!-- Privacy Policy Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in text-center">
                    <h1 class="section-title">{{ __('messages.footer.privacy_policy') }}</h1>
                    <p class="lead">{{ __('messages.privacy.hero.subtitle') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Privacy Policy Content -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="legal-content">
                        <h2>{{ __('messages.privacy.section1.title') }}</h2>
                        <p>{{ __('messages.privacy.section1.content') }}</p>

                        <h2>{{ __('messages.privacy.section2.title') }}</h2>
                        <p>{{ __('messages.privacy.section2.content') }}</p>
                        <ul>
                            @if(is_array(__('messages.privacy.section2.list')))
                                @foreach(__('messages.privacy.section2.list') as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            @endif
                        </ul>

                        <h2>{{ __('messages.privacy.section3.title') }}</h2>
                        <p>{{ __('messages.privacy.section3.content') }}</p>

                        <h2>{{ __('messages.privacy.section4.title') }}</h2>
                        <p>{{ __('messages.privacy.section4.content') }}</p>

                        <h2>{{ __('messages.privacy.section5.title') }}</h2>
                        <p>{{ __('messages.privacy.section5.content') }}</p>

                        <h2>{{ __('messages.privacy.section6.title') }}</h2>
                        <p>{{ __('messages.privacy.section6.content') }}</p>

                        <h2>{{ __('messages.privacy.section7.title') }}</h2>
                        <p>{{ __('messages.privacy.section7.content') }}</p>

                        <h2>{{ __('messages.privacy.section8.title') }}</h2>
                        <p>{{ __('messages.privacy.section8.content') }}</p>
                        <p>
                            <strong>{{ __('messages.privacy.contact.company') }}</strong><br>
                            {{ __('messages.privacy.contact.email') }}<br>
                            {{ __('messages.privacy.contact.phone') }}
                        </p>

                        <p class="text-muted mt-4">
                            <small>{{ __('messages.privacy.last_updated') }} {{ date('d/m/Y') }}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .container {
        max-width: 1345px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .legal-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }
    
    .legal-content h2 {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.5rem;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .legal-content h2:first-child {
        margin-top: 0;
    }
    
    .legal-content p {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }
    
    .legal-content ul {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }
    
    .legal-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush