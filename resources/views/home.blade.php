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
                    <h4 class="mt-3 mb-0">Available Vendor</h4>
                    <hr class="mt-0" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Weekdays</th>
                                <th scope="col">Time Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendorAvailability as $vendor_availability)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$vendor_availability->vendor()->first()->name}}</td>
                                <td>{{$vendor_availability->weekday_name}}</td>
                                <td>{{$vendor_availability->startTime}} - {{$vendor_availability->endTime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="mt-3 mb-0">My Bookings</h4>
                    <hr class="mt-0" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr</th>
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Weekdays</th>
                                <th scope="col">Time Slot</th>
                                <th scope="col">Booking Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$booking->vendor()->first()->name}}</td>
                                <td>{{$booking->weekday_name}}</td>
                                <td>{{$booking->startTime}} - {{$booking->endTime}}</td>
                                <td>{{$booking->booking_time}} </td>
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
                    <h4 class="mt-3 mb-0">Availability</h4>
                    <hr class="mt-0" />
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
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$vendor_availability->vendor()->first()->name}}</td>
                                <td>{{$vendor_availability->weekday_name}}</td>
                                <td>{{$vendor_availability->startTime}} - {{$vendor_availability->endTime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="mt-3 mb-0">Reschedule Off</h4>
                    <hr class="mt-0" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendorRescheduleOff as $vendor_reschedule_off)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$vendor_reschedule_off->date}}</td>
                                <td>{{$vendor_reschedule_off->startTime}} - {{$vendor_reschedule_off->endTime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="mt-3 mb-0">Booked Time Slot</h4>
                    <hr class="mt-0" />
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Weekdays</th>
                                <th scope="col">Time Slot</th>
                                <th scope="col">Booking Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$booking->user()->first()->name}}</td>
                                <td>{{$booking->weekday_name}}</td>
                                <td>{{$booking->startTime}} - {{$booking->endTime}}</td>
                                <td>{{$booking->booking_time}} </td>
                            </tr>
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