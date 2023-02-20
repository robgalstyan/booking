
@extends('layouts.app')
@section('content')
    <div class="row">

    </div>
    <div class="main-div">
        <div class="rooms-info">
            <table class="table">
                <tr style="color: navy">
                    <th scope="col">Room number</th>
                    <th scope="col">Price($)</th>
                    <th scope="col">Book Start</th>
                    <th scope="col">Book End</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach($bookings as $booking)

                    <tr style="color: #1a202c; font-weight: bold">
                        <td>{{ $booking->room->number }}</td>
                        <td>{{ $booking->room->price }}</td>
                        <td>{{ $booking->book_start }}</td>
                        <td>{{ $booking->book_end }}</td>
                        <td>
                            <a href="{{ url('booking/' . $booking->id . '/edit') }}">
                                <button class="btn btn-info">Edit</button>
                            </a>
                            <a href="{{ url('booking/'.$booking->id.'/delete') }}">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div>{{$bookings->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
@endsection
