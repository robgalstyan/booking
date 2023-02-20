@extends('layouts.app')
@section('content')
    @if($errors->has('book_start'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('book_start')}}</div>
    @endif
    @if($errors->has('book_end'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('book_end')}}</div>
    @endif
    <form action="{{ url('booking/'.$booking->id.'/update') }}" method="POST">
        @csrf
        <div class="form-inline">
            <div class="form-group">
                <label for="book-start">Start</label>
                <input type="date" name="book_start" value="{{ date($booking->book_start) }}" class="form-control" id="book-start" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="book-end">End</label>
                <input type="date" name="book_end" value="{{ $booking->book_end }}" class="form-control" id="book-end">
            </div>
        </div>

        <div class="form-group">
            <label for="number">Room number</label>
            <input name="number" type="text" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Room number" value="{{ $booking->room->number }}" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="Price" value="{{ $booking->room->price }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url('booking/all') }}">
            <button type="button" class="btn btn-default">Cancel</button>
        </a>
    </form>
@endsection
