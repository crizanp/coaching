@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('Admin Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3>{{ $stats['services'] }}</h3>
                                            <p class="mb-0">Services</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-concierge-bell fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3>{{ $stats['appointments'] }}</h3>
                                            <p class="mb-0">Total Appointments</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar-alt fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3>{{ $stats['pending_appointments'] }}</h3>
                                            <p class="mb-0">Pending Appointments</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3>{{ $stats['testimonials'] }}</h3>
                                            <p class="mb-0">Testimonials</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-star fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Quick Actions</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-concierge-bell"></i> <span class="d-none d-sm-inline">Manage Services</span>
                                </a>
                                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-success">
                                    <i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline">View Appointments</span>
                                </a>
                                <a href="{{ route('admin.settings') }}" class="btn btn-outline-info">
                                    <i class="fas fa-cog"></i> <span class="d-none d-sm-inline">Settings</span>
                                </a>
                                <a href="{{ route('admin.change-password') }}" class="btn btn-outline-warning">
                                    <i class="fas fa-key"></i> <span class="d-none d-sm-inline">Change Password</span>
                                </a>
                                <a href="{{ url('/fr') }}" class="btn btn-outline-secondary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> <span class="d-none d-sm-inline">View Site</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Appointments -->
                    @if($recent_appointments->count() > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Recent Appointments</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_appointments as $appointment)
                                        <tr>
                                            <td>
                                                <strong>{{ $appointment->client_name }}</strong><br>
                                                <small class="text-muted">{{ $appointment->client_email }}</small>
                                            </td>
                                            <td>
                                                @if($appointment->service)
                                                    {{ $appointment->service->getTranslation('name', 'fr') }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $appointment->appointment_datetime->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection