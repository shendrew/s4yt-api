@extends('layouts.admin')

@section('content')

    <div class="container">
        <!-- title -->
        <div class="container content-section">
            <h2 class="col-lg-12 text-center">New Player</h2>
        </div>
        <!-- resource actions -->
        <div class="container content-section col-lg-10 offset-lg-1 mt-3">
            <a href="{{ route('player.index') }}" class="btn btn-primary text-white">
                <i class="fas fa-backward mr-2"></i>
                Go back
            </a>
        </div>
        <!-- form -->
        <div class="container content-section mt-3">
            <form action="{{ route('player.store') }}" method="POST" autocomplete="off" class="col-lg-6 offset-lg-3 mb-5">
                @csrf
                <div class="form-group mt-2">
                    <label for="name">Name (Required)</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name_error">
                    @if ($errors->has('name'))
                        <small id="name_error" class="form-text text-danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email (Required)</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email_error">
                    @if ($errors->has('email'))
                        <small id="email_error" class="form-text text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="preferred_email">Preferred Email</label>
                    <input type="email" class="form-control" id="preferred_email" name="preferred_email">
                </div>
                <div class="form-group mt-2">
                    <label for="institution">Institution</label>
                    <input type="text" class="form-control" id="institution" name="institution">
                </div>
                <div class="form-group mt-2">
                    <label for="grade">Grade (Required)</label>
                    <input type="text" class="form-control" id="grade" name="grade" aria-describedby="grade_error">
                    @if ($errors->has('grade'))
                        <small id="grade_error" class="form-text text-danger">{{ $errors->first('grade') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group mt-2">
                    <label for="dob">Birth date</label>
                    <input type="text" class="form-control" id="dob" name="dob" aria-describedby="dob_format">
                    <small id="dob_format" class="form-text text-dark">Format: mm-dd-yyyy</small>
                </div>
                <div class="form-group mt-2">
                    <label for="city_state">City/State (Required)</label>
                    <input type="text" class="form-control" id="city_state" name="city_state" aria-describedby="city_state_error">
                    @if ($errors->has('city_state'))
                        <small id="city_state_error" class="form-text text-danger">{{ $errors->first('city_state') }}</small>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary col-lg-12 text-white fw-bold">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
