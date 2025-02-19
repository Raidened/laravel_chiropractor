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
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Client Note') }}</th>
                                <th>{{ __('Delete') }}</th>
                                <th>{{ __('Date de début') }}</th>
                                <th>{{ __('Date de fin') }}</th>
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
                                            <td>{{ $appointment->status }}</td>
                                            <td>{{ $appointment->client_note }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="date" class="form-control"
                                                           name="date"
                                                           min="{{ date('Y-m-d') }}"
                                                           max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                                           value="{{ old('date', date('Y-m-d', strtotime($appointment->schedule->day)))}}">

                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
