@extends('layouts.app')

@section('content')
<div class="container-fluid admin-container">
    @yield('content')
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #0a0a0a !important;
        color: #e9e9e9 !important;
    }
    
    .admin-container {
        padding: 2rem 0;
        min-height: calc(100vh - 76px);
    }
    
    .card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        color: #e9e9e9 !important;
    }
    
    .card-header {
        background-color: #252525 !important;
        border-bottom: 1px solid #333 !important;
        color: #fff !important;
    }
    
    .table {
        color: #e9e9e9 !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
    }
    
    .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    
    .btn-outline-primary {
        color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    
    .btn-outline-primary:hover {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }
    
    .form-control, .form-select {
        background-color: #333 !important;
        border-color: #555 !important;
        color: #e9e9e9 !important;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: #333 !important;
        border-color: #0d6efd !important;
        color: #e9e9e9 !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    
    .form-label {
        color: #e9e9e9 !important;
    }
    
    .text-muted {
        color: #adb5bd !important;
    }
    
    .badge {
        color: #fff !important;
    }
    
    .pagination .page-link {
        background-color: #333 !important;
        border-color: #555 !important;
        color: #e9e9e9 !important;
    }
    
    .pagination .page-link:hover {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    
    .alert-success {
        background-color: #0f5132 !important;
        border-color: #0a3622 !important;
        color: #75b798 !important;
    }
    
    .alert-danger {
        background-color: #58151c !important;
        border-color: #842029 !important;
        color: #ea868f !important;
    }
</style>
@endpush

@push('scripts')
@stack('scripts')
@endpush