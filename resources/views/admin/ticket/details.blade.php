@extends('layouts.app')
@include('dashboard.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($ticket) ? 'Ticket Details' : 'Create Ticket' }}</div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label">Ticket Name</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ isset($ticket) ? $ticket->title : '' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                      readonly>{{ isset($ticket) ? $ticket->description : '' }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="assigned_user" class="form-label">Assigned User</label>
                                <input type="text" class="form-control" id="assigned_user" name="assigned_user"
                                       value="{{ isset($ticket) ? $ticket->assignedUser->name : '' }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status"
                                       value="{{ isset($ticket) ? ucfirst($ticket->status) : '' }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="text" class="form-control" id="due_date" name="due_date"
                                       value="{{ isset($ticket) ? $ticket->due_date : '' }}" readonly>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            @if(isset($ticket->deleted_at))
                                <form action="{{ route('admin.ticket.restore', $ticket->id) }}"
                                      method="POST"
                                      style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Restore</button>
                                </form>
                            @else
                                <a href="{{ route('admin.ticket.edit', $ticket->id) }}" class="btn btn-primary">Edit</a>
                            @endif
                        </div>

                        <div class="card">
                            <div class="card-header">Ticket Logs</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Previous Status</th>
                                        <th>Current Status</th>
                                        <th>Comment</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ticket->ticketLogs as $log)
                                        <tr>
                                            <td>{{ $log->user->name }}</td>
                                            <td>{{ $log->previous_status }}</td>
                                            <td>{{ $log->current_status }}</td>
                                            <td>{{ $log->comment }}</td>
                                            <td>{{ $log->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
