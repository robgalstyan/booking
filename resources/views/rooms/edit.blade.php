@extends('layouts.app')
@section('content')
    @if($errors->has('number'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('number')}}</div>
    @endif
    @if($errors->has('price'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('price')}}</div>
    @endif
    <form action="{{ url('room/'.$room->id.'/update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="number">Room number</label>
            <input type="text" name="number" value="{{ $room->number }}" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Room number">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" value="{{ $room->price }}" class="form-control" id="price" placeholder="Price">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ url('room/all') }}">
            <button type="button" class="btn btn-default">Cancel</button>
        </a>
    </form>
@endsection
