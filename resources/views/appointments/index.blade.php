@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('My Appointments') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Doctor</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->date->format('Y-m-d') }}</td>
                                    <td>{{ $appointment->date->format('H:i') }}</td>
                                    <td>{{ $appointment->doctor_name }}</td>
                                    <td>{{ $appointment->type }}</td>
                                    <td>
                                        @if($appointment->status)
                                            <span class="badge bg-success">Confirmed</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($appointment->date->diffInHours(now()) >= 24)
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="alert('You cannot cancel an appointment less than 24 hours before the scheduled time.')">
                                                Cancel
                                            </button>
                                        @endif
                                    </td>
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
@endsection
