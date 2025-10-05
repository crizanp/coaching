@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Service Details') }}</h4>
                        <div>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('services.show', ['fr', $service->slug]) }}" class="btn btn-outline-secondary" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View Live
                            </a>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h5>French Content</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $service->getTranslation('name', 'fr') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td>{{ $service->getTranslation('description', 'fr') }}</td>
                                </tr>
                                @php
                                    $benefitsFr = $service->getLocalizedTranslation('benefits', 'fr');
                                @endphp
                                @if($benefitsFr && is_array($benefitsFr))
                                <tr>
                                    <td><strong>Benefits:</strong></td>
                                    <td>
                                        @foreach($benefitsFr as $benefit)
                                            <span class="badge bg-primary me-1 mb-1">{{ $benefit }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                @php
                                    $sessionFormatFr = $service->getLocalizedTranslation('session_format', 'fr');
                                @endphp
                                @if($sessionFormatFr && is_array($sessionFormatFr))
                                <tr>
                                    <td><strong>Session Format:</strong></td>
                                    <td>
                                        @foreach($sessionFormatFr as $format)
                                            <span class="badge bg-info me-1 mb-1">{{ $format }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>English Content</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $service->getTranslation('name', 'en') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td>{{ $service->getTranslation('description', 'en') }}</td>
                                </tr>
                                @php
                                    $benefitsEn = $service->getLocalizedTranslation('benefits', 'en');
                                @endphp
                                @if($benefitsEn && is_array($benefitsEn))
                                <tr>
                                    <td><strong>Benefits:</strong></td>
                                    <td>
                                        @foreach($benefitsEn as $benefit)
                                            <span class="badge bg-primary me-1 mb-1">{{ $benefit }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                @php
                                    $sessionFormatEn = $service->getLocalizedTranslation('session_format', 'en');
                                @endphp
                                @if($sessionFormatEn && is_array($sessionFormatEn))
                                <tr>
                                    <td><strong>Session Format:</strong></td>
                                    <td>
                                        @foreach($sessionFormatEn as $format)
                                            <span class="badge bg-info me-1 mb-1">{{ $format }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Service Information</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Slug:</strong></td>
                                            <td><code>{{ $service->slug }}</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Icon:</strong></td>
                                            <td><i class="fas fa-{{ $service->icon }}"></i> {{ $service->icon }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Individual Price:</strong></td>
                                            <td>{{ $service->price_individual ? number_format($service->price_individual, 0) . '€' : 'Not set' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Duration:</strong></td>
                                            <td>{{ $service->duration ? $service->duration . ' minutes' : 'Not set' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sort Order:</strong></td>
                                            <td>{{ $service->sort_order }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Featured:</strong></td>
                                            <td>
                                                @if($service->is_featured)
                                                    <span class="badge bg-warning">Yes</span>
                                                @else
                                                    <span class="badge bg-secondary">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($service->getTranslation('content', 'fr') || $service->getTranslation('content', 'en'))
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>French Content</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {!! $service->getTranslation('content', 'fr') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>English Content</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {!! $service->getTranslation('content', 'en') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5>Actions</h5>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit Service
                                </a>
                                <a href="{{ route('services.show', ['fr', $service->slug]) }}" class="btn btn-outline-secondary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> View on Site
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i> Delete Service
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection