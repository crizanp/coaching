@extends('layouts.frontend')

@section('title', __('messages.terms.page.title'))
@section('description', __('messages.terms.page.description'))

@section('content')
<!-- Terms & Conditions Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in text-center">
                    <h1 class="section-title">{{ __('messages.footer.terms_conditions') }}</h1>
                    <p class="lead">{{ __('messages.terms.hero.subtitle') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Terms & Conditions Content -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="legal-content">
                        <h2>{{ __('messages.terms.section1.title') }}</h2>
                        <p>{{ __('messages.terms.section1.content') }}</p>

                        <h2>{{ __('messages.terms.section2.title') }}</h2>
                        <p>{{ __('messages.terms.section2.content') }}</p>
                        <ul>
                            @if(is_array(__('messages.terms.section2.list')))
                                @foreach(__('messages.terms.section2.list') as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            @endif
                        </ul>

                        <h2>{{ __('messages.terms.section3.title') }}</h2>
                        <p>{{ __('messages.terms.section3.content') }}</p>

                        <h2>{{ __('messages.terms.section4.title') }}</h2>
                        <p>{{ __('messages.terms.section4.content') }}</p>
                        <p><strong>{{ __('messages.terms.section4.cancellation') }}</strong></p>

                        <h2>{{ __('messages.terms.section5.title') }}</h2>
                        <p>{{ __('messages.terms.section5.content') }}</p>
                        <ul>
                            @foreach(__('messages.terms.section5.list') as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>

                        <h2>{{ __('messages.terms.section6.title') }}</h2>
                        <p>{{ __('messages.terms.section6.content') }}</p>

                        <h2>{{ __('messages.terms.section7.title') }}</h2>
                        <p>{{ __('messages.terms.section7.content') }}</p>
                        <p>{{ __('messages.terms.section7.content2') }}</p>

                        <h2>{{ __('messages.terms.section8.title') }}</h2>
                        <p>{{ __('messages.terms.section8.content') }}</p>

                        <h2>{{ __('messages.terms.section9.title') }}</h2>
                        <p>{{ __('messages.terms.section9.content') }}</p>

                        <h2>{{ __('messages.terms.section10.title') }}</h2>
                        <p>{{ __('messages.terms.section10.content') }}</p>

                        <h2>{{ __('messages.terms.section11.title') }}</h2>
                        <p>{{ __('messages.terms.section11.content') }}</p>
                        <p>
                            <strong>{{ __('messages.terms.contact.company') }}</strong><br>
                            {{ __('messages.terms.contact.email') }}<br>
                            {{ __('messages.terms.contact.phone') }}<br>
                            {{ __('messages.terms.contact.address') }}
                        </p>

                        <p class="text-muted mt-4">
                            <small>{{ __('messages.terms.last_updated') }} {{ date('d/m/Y') }}</small>
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
    
    .legal-content strong {
        color: var(--text-dark);
        font-weight: 600;
    }
</style>
@endpush