@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Appointments Management') }}</h4>
                        <div>
                            <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> New Appointment
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-dashboard"></i> Dashboard
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

                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Service</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Language</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>
                                            <strong>{{ $appointment->client_name }}</strong><br>
                                            <small class="text-muted">{{ $appointment->client_email }}</small>
                                        </td>
                                        <td>
                                            @if($appointment->service)
                                                {{ $appointment->service->getTranslation('name', 'fr') }}
                                            @else
                                                <span class="text-muted">Service deleted</span>
                                            @endif
                                        </td>
                                        <td>{{ $appointment->appointment_datetime->format('d/m/Y H:i') }}</td>
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
                                        <td>
                                            <span class="badge bg-{{ $appointment->preferred_language === 'fr' ? 'primary' : 'success' }}">
                                                {{ strtoupper($appointment->preferred_language) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No appointments found</h5>
                            <p class="text-muted">Create your first appointment or wait for clients to book.</p>
                            <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create First Appointment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection