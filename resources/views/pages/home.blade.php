@extends('layouts.layout')
@section('main-content')
    @if (session('login.success'))
        {!! session('login.success') !!}
    @endif
@endsection
