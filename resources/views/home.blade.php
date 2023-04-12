@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(auth()->user()->hasRole('user'))
                    <form method="POST" action="{{route('booking')}}">
                        @csrf
                        <input type="date" name="booking_date" required />
                        <input type="time" name="booking_time" required />
                        <button>Book</button>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr</th>
                                <th scope="col">Name</th>
                                <th scope="col">Weekdays</th>
                                <th scope="col">Time Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendorAvailability as $vendor_availability)
                            <tr>
                                <th scope="row">1</th>
                                <td></td>
                                <td>{{$vendor_availability->weekday_name}}</td>
                                <td>{{$vendor_availability->startTime}} - {{$vendor_availability->endTime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="d-flex gap-2">
                        <a href="{{route('availability')}}" class="btn btn-sm btn-info       ">
                            Availability
                        </a>
                        <a href="{{route('reschedule-off')}}" class="btn btn-sm btn-info       ">
                            Reschedule Off
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection