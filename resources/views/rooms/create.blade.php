@extends('layouts.app')
@section('content')
    @if($errors->has('number'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('number')}}</div>
    @endif
    @if($errors->has('price'))
        <div class="form-group col-md-4 has-error alert alert-danger">{{$errors->first('price')}}</div>
    @endif
    <form action="{{ url('room/create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="number">Room number</label>
            <input name="number" type="text" class="form-control" id="number" aria-describedby="emailHelp" placeholder="Room number">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="text" class="form-control" id="price" placeholder="Price">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ url('room/all') }}">
            <button type="button" class="btn btn-default">Cancel</button>
        </a>
    </form>
@endsection

