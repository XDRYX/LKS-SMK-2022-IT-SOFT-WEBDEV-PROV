@extends('layouts.layout')
@section('main-content')
@if (session('update.success'))
    {!! session('update.success') !!}
@endif
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">General Elements</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('update.profile') }}" method="POST">
                @csrf
                <div class="form-group">
                    @csrf
                    <div class="form-group mt-4">
                        <label>First Name</label>
                        <input name="first_name" type="text" class="form-control @error('first_name')
                        is-invalid
                        @enderror" placeholder="First Name" value="{{ $user['first_name'] }}">
                    </div>
                    <div class="form-group mt-4">
                        <label>Last Name</label>
                        <input name="last_name" type="text" class="form-control @error('last_name')
                        is-invalid
                        @enderror" placeholder="First Name" value="{{ $user['last_name'] }}">
                    </div>
                    <div class="form-group mt-4">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control @error('email')
                        is-invalid
                        @enderror" placeholder="First Name" value="{{ $user['email'] }}">
                    </div>
                    <div class="form-group mt-4">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control @error('password')
                        is-invalid
                        @enderror" placeholder="First Name">
                    </div>
                    <div class="form-group mt-4">
                        <label>Phone</label>
                        <input name="phone" type="text" class="form-control @error('phone')
                        is-invalid
                        @enderror" placeholder="First Name" value="{{ $user['phone'] }}">
                    </div>
                    <div class="form-group mt-4">
                        <label>Address</label>
                        <textarea name="address" class="form-control @error('address')
                        is-invalid
                        @enderror" rows="3" placeholder="Enter ...">{{ $user['address'] }}</textarea>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
