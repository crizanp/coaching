@extends('layouts.admin')

@section('title', 'Guide Download Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guide Download Details</h1>
        <a href="{{ route('admin.guide-downloads.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Request Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Name:</div>
                        <div class="col-sm-9">{{ $guideDownload->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Email:</div>
                        <div class="col-sm-9">
                            <a href="mailto:{{ $guideDownload->email }}">{{ $guideDownload->email }}</a>
                        </div>
                    </div>
                    @if($guideDownload->phone)
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Phone:</div>
                        <div class="col-sm-9">
                            <a href="tel:{{ $guideDownload->phone }}">{{ $guideDownload->phone }}</a>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">IP Address:</div>
                        <div class="col-sm-9">{{ $guideDownload->ip_address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Guide Requested:</div>
                        <div class="col-sm-9">{{ $guideDownload->guide_title }}</div>
                    </div>
                    @if($guideDownload->guide_description)
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Description:</div>
                        <div class="col-sm-9">{{ $guideDownload->guide_description }}</div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Status:</div>
                        <div class="col-sm-9">{!! $guideDownload->status_badge !!}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Requested At:</div>
                        <div class="col-sm-9">{{ $guideDownload->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    @if($guideDownload->approved_at)
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Approved At:</div>
                        <div class="col-sm-9">{{ $guideDownload->approved_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    @endif
                    @if($guideDownload->sent_at)
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sent At:</div>
                        <div class="col-sm-9">{{ $guideDownload->sent_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    @endif
                    @if($guideDownload->admin_notes)
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Admin Notes:</div>
                        <div class="col-sm-9">{{ $guideDownload->admin_notes }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                </div>
                <div class="card-body">
                    @if($guideDownload->status === 'pending')
                    <form method="POST" action="{{ route('admin.guide-downloads.approve', $guideDownload) }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Approve this request?')">
                            <i class="fas fa-check"></i> Approve Request
                        </button>
                    </form>

                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#rejectModal">
                        <i class="fas fa-times"></i> Reject Request
                    </button>
                    @endif

                    @if($guideDownload->status === 'approved')
                    <form method="POST" action="{{ route('admin.guide-downloads.send', $guideDownload) }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Send guide to this email?')">
                            <i class="fas fa-paper-plane"></i> Send Guide
                        </button>
                    </form>
                    @endif

                    @if($guideDownload->status === 'sent')
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Guide has been sent successfully.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.guide-downloads.destroy', $guideDownload) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Delete this request permanently?')">
                            <i class="fas fa-trash"></i> Delete Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.guide-downloads.reject', $guideDownload) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Reject Request</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Reason (optional):</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Enter reason for rejection..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection