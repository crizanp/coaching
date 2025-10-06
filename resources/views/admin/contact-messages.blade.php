@extends('layouts.admin')

@section('page-title', 'Contact Messages')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Contact Messages</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if($messages->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Interested Service</th>
                                <th>Message</th>
                                <th>Received At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>
                                    <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                        {{ $message->email }}
                                    </a>
                                </td>
                                <td>
                                    @if($message->phone)
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $message->phone) }}" class="text-decoration-none">
                                            {{ $message->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($message->service)
                                        {{ $message->service->getTranslation('name', app()->getLocale()) ?? $message->service->name }}
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </td>
                                <td style="white-space: pre-wrap; min-width: 250px;">{{ $message->message }}</td>
                                <td>{{ $message->created_at->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} messages
                    </div>
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-envelope-open-text fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No contact messages yet</h5>
                    <p class="text-muted mb-0">Messages from your contact form will show up here once visitors reach out.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
