@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Dashboard') }}
                    @if(auth()->user()->rank == 0)
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Book Appointment</a>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center mt-5">
                                Full Calendar
                            </h3>
                            <div class="col-md-11 offset-1 mt-5 mb-5">
                                <div id="calendar">

                                </div>
                            </div>
                        </div>
                    </div>


                </div>







            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var booking = @json($events ?? []);
        $('#calendar').fullCalendar({
            header:{
                left: 'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay',
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            defaultView: 'month',
            displayEventTime: true,
            eventRender: function(event, element) {
                element.find('.fc-title').append("<br/>" + event.doctor_name);
            }
        });
    });
</script>
@endsection
