
@extends('layouts.app')
@section('content')

@if($errors->has('authorization_error'))
    <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('authorization_error')}}</div>
@endif
<div class="main-div">
    <div class="head">
        <form class="form-inline" style="margin: 20px 0" action="{{ url('room/all') }}" method="GET">
            <div class="form-group mx-sm-3 mb-2">
                <label for="start" class="sr-only">Start</label>
                <input name="book_start" type="date" class="form-control" id="start" value="{{ date('Y-m-d', strtotime(now())) }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="end" class="sr-only">End</label>
                <input name="book_end" type="date" class="form-control" id="end" value="{{ date('Y-m-d', strtotime(now())) }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
        </form>
    </div>
    <div class="rooms-info">
        <table class="table">
            <tr style="color: navy">
                <th scope="col">Room number</th>
                <th scope="col">Price($)</th>
                <th scope="col">Status</th>
                @if(auth()->user()->hasRole('admin'))
                    <th scope="col">Action(s)</th>
                @endif
            </tr>
            @foreach($rooms as $room)
                <?php
                    $myBooking = false;
                ?>


                @foreach($room->bookings as $booking)
                    @if($booking && $booking->user_id == auth()->user()->id)
                        <?php
                            $myBooking = true;
                        ?>
                    @endif
                @endforeach
                <tr style="color: #1a202c; font-weight: bold" class="<?php echo $myBooking ? 'my-booking' : '' ?>">

                    <td style="display: none" class="room-id">{{ $room->id }}</td>
                    <td>{{ $room->number }}</td>
                    <td>{{ $room->price }}</td>

                    @if($room->bookings && count($room->bookings))
                        <td>Booked</td>
                    @else
                        <td>Available</td>
                    @endif
                    <td>
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ url('room/edit/'.$room->id) }}">
                                <button class="btn btn-info">Edit</button>
                            </a>
                            <a href="{{ url('room/'.$room->id.'/delete') }}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        @else
                            @foreach($room->bookings as $booking)
                                @if($booking && $booking->guest->id == auth()->user()->id)

                                @endif
                            @endforeach

                        @endif
                    </td>
                    <td>
                    @if(auth()->user()->hasRole('guest') && (!$room->bookings || !count($room->bookings)))
                        <a href="{{ url('room/'.$room->id.'/booking') }}">
                            <button class="btn btn-info">Book Now</button>
                        </a>
                    @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <div>{{$rooms->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection
