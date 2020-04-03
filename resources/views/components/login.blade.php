@extends('main-layout')

@section('content')
    {{-- <button class="btn btn-danger" type="button">Login Gmail</button> --}}
    <a href="{{ url('/redirect') }}" class="btn btn-primary">Login With Google</a>
@endsection