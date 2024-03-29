@extends('layouts.app')
@include('dashboard.navbar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST"
                              action="{{ isset($ticket) ? route('admin.ticket.update', $ticket->id) : route('admin.ticket.store') }}">
                            @csrf
                            @if(isset($ticket))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label">Ticket Name</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                       name="title"
                                       value="{{ old('title', isset($ticket) ? $ticket->title : '') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3"
                                          required>{{ old('description', isset($ticket) ? $ticket->description : '') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="assigned_user" class="form-label">Assigned User</label>
                                    <select class="form-select @error('assigned_user') is-invalid @enderror"
                                            id="assigned_user" name="assigned_user" required>
                                        <option value="" selected disabled>Select User</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{ $staff->id }}" {{ old('assigned_user', isset($ticket) && $ticket->assigned_user == $staff->id) ? 'selected' : '' }}>{{ $staff->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assigned_user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                            name="status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="pending" {{ old('status', isset($ticket) && $ticket->status == 'pending') ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="wip" {{ old('status', isset($ticket) && $ticket->status == 'wip') ? 'selected' : '' }}>
                                            Work in Progress
                                        </option>
                                        <option value="completed" {{ old('status', isset($ticket) && $ticket->status == 'completed') ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                           id="due_date" name="due_date"
                                           value="{{ old('due_date', isset($ticket) ? $ticket->due_date : '') }}"
                                           required>
                                    @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($ticket) ? 'Update' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
