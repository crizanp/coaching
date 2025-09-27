@extends('layouts.frontend')

@section('title', __('messages.services.title'))

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title">{{ __('messages.services.title') }}</h1>
            <p class="section-subtitle">{{ __('messages.services.subtitle') }}</p>
        </div>
        
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 mb-5 fade-in">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon">
                            @switch($service->icon)
                                @case('leaf')
                                    <i class="fas fa-leaf"></i>
                                    @break
                                @case('moon')
                                    <i class="fas fa-moon"></i>
                                    @break
                                @case('brain')
                                    <i class="fas fa-brain"></i>
                                    @break
                                @default
                                    <i class="fas fa-heart"></i>
                            @endswitch
                        </div>
                        <h3 class="mb-3">{{ $service->getTranslation('name', app()->getLocale()) }}</h3>
                        <p class="text-muted mb-4">{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                        
                        <div class="mb-4">
                            @if($service->price_individual)
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    {{ __('messages.services.price_individual') }}: {{ number_format($service->price_individual, 0) }}€
                                </span>
                            </div>
                            @endif
                            
                            @if($service->price_group)
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    {{ __('messages.services.price_group') }}: {{ number_format($service->price_group, 0) }}€
                                </span>
                            </div>
                            @endif
                            
                            @if($service->duration)
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    {{ __('messages.services.duration') }}: {{ $service->duration }}
                                </span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('services.show', [app()->getLocale(), $service->slug]) }}" class="btn btn-outline-primary">
                                {{ __('messages.services.learn_more') }}
                            </a>
                            <a href="{{ route('booking.index', app()->getLocale()) }}?service={{ $service->id }}" class="btn btn-primary">
                                {{ __('messages.services.book_now') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection