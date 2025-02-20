@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Appointments') }}</div>

                    <div class="card-body">
                        @if($appointments->isEmpty())
                            <p>{{ __('No appointments found.') }}</p>
                        @else
                            <table class="table">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Doctor Name') }}</th>
                                <th>{{ __('Client Name') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Client Note') }}</th>
                                <th>{{ __('Delete') }}</th>
                                <th>{{ __('Schedules') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    @if(Auth::user()->name == $appointment->doctor_name)
                                        <tr>
                                            <td>{{ $appointment->id }}</td>
                                            <td>{{ $appointment->doctor_name }}</td>
                                            <td>{{ $appointment->user->name }}</td>
                                            <td>{{ $appointment->type }}</td>
                                            <form method="POST" action="{{ route('admin.modifyStatus', $appointment->id) }}">
                                                @csrf
                                                <td>
                                                    <select name="status" id="status" onchange="this.form.submit()">
                                                        <option value="0" {{ $appointment->status == 0 ? 'selected' : '' }}>Soon</option>
                                                        <option value="1" {{ $appointment->status == 1 ? 'selected' : '' }}>Passed</option>
                                                    </select>
                                                </td>
                                            </form>

                                            <td>{{ $appointment->client_note }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.modify', $appointment->id) }}" method="POST">
                                                    @csrf

                                                    <input type="date" class="form-control"
                                                           name="date"
                                                           min="{{ date('Y-m-d') }}"
                                                           max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                                           value="{{ $appointment->schedule->day->format('Y-m-d') }}"
                                                           onchange="this.form.submit()">
                                                    <input type="time" class="form-control"
                                                           name="hour_start"
                                                           value="{{ $appointment->schedule->hour_start->format('H:i') }}"
                                                           onchange="this.form.submit()">
                                                    <input type="time" class="form-control"
                                                           name="hour_end"
                                                           min="{{ $appointment->schedule->hour_start }}"
                                                           value="{{ $appointment->schedule->hour_end->format('H:i') }}"
                                                           onchange="this.form.submit()">

                                                </form>
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
