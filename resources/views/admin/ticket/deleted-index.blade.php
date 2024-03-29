@extends('layouts.app')
@include('dashboard.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Tickets') }}</span>
                            <a href="{{ route('admin.ticket.index') }}"
                               class="btn btn-primary">{{ __('Active Tickets') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($tickets->isEmpty())
                            <div class="alert alert-info" role="alert">
                                No tickets available.
                            </div>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Assigned User</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->assignedUser->name }}</td>
                                        <td>
                                            @if($ticket->status == 'pending')
                                                <span class="badge bg-primary">PENDING</span>
                                            @elseif($ticket->status == 'wip')
                                                <span class="badge bg-secondary">WORK IN PROGRESS</span>
                                            @elseif($ticket->status == 'Completed')
                                                <span class="badge bg-success">COMPLETED</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->createdBy->name }}</td>
                                        <td>{{ $ticket->created_at }}</td>
                                        <td>{{ $ticket->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.ticket.view', $ticket->id) }}"
                                               class="btn btn-primary">View</a>
                                            <form action="{{ route('admin.ticket.restore', $ticket->id) }}"
                                                  method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary">Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $tickets->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
