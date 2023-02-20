@extends('layouts.app')
@section('content')
    @if($errors->has('book_start'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('book_start')}}</div>
    @endif
    @if($errors->has('book_end'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('book_end')}}</div>
    @endif
    <form action="{{ url('room/' . $room->id . '/booking') }}" method="POST">
        @csrf

        <div class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="start">Book Start</label>
                <input name="book_start" type="date" class="form-control" id="start" value="{{ date('Y-m-d', strtotime(now())) }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="end">Book End</label>
                <input name="book_end" type="date" class="form-control" id="end" value="{{ date('Y-m-d', strtotime(now())) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="number">Room number</label>
            <input name="number" type="text" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Room number" value="{{ $room->number }}" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="Price" value="{{ $room->price }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
        <a href="{{ url('room/all') }}">
            <button type="button" class="btn btn-default">Cancel</button>
        </a>
    </form>
@endsection

