@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Appointment Details') }}</h4>
                        <div>
                            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
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
                            <h5>Client Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $appointment->client_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>
                                        <a href="mailto:{{ $appointment->client_email }}">{{ $appointment->client_email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Preferred Language:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->preferred_language === 'fr' ? 'primary' : 'success' }}">
                                            {{ $appointment->preferred_language === 'fr' ? 'Français' : 'English' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>Appointment Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Service:</strong></td>
                                    <td>
                                        @if($appointment->service)
                                            {{ $appointment->service->getLocalizedTranslation('name', app()->getLocale()) }}
                                        @else
                                            <span class="text-muted">Service no longer available</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Date & Time:</strong></td>
                                    <td>{{ $appointment->appointment_datetime->format('l, F j, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.appointments.status', $appointment) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $appointment->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($appointment->message)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Client Message</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    {{ $appointment->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Actions</h5>
                            <div class="btn-group" role="group">
                                <a href="mailto:{{ $appointment->client_email }}?subject=Regarding your appointment on {{ $appointment->appointment_datetime->format('d/m/Y') }}" 
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-envelope"></i> Send Email
                                </a>
                                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-outline-success">
                                    <i class="fas fa-edit"></i> Edit Appointment
                                </a>
                                <form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i> Delete
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