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
                    <label for="education">Education</label>
                    <select class="form-select form-control" aria-label="Default select example" id="education" name="education">
                        <option value="0" selected>Choose an option</option>
                        @foreach($educations as $education)
                            <option value="{{ $education->id }}">{{ $education->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2" id="institution_input">
                    <label for="institution">Institution</label>
                    <input type="text" class="form-control" id="institution" name="institution">
                    @if ($errors->has('institution'))
                        <small id="institution_error" class="form-text text-danger">{{ $errors->first('institution') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="grade">Grade (Required)</label>
                    <input type="text" class="form-control" id="grade" name="grade" aria-describedby="grade_error">
                    @if ($errors->has('grade'))
                        <small id="grade_error" class="form-text text-danger">{{ $errors->first('grade') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="country">Country (Required)</label>
                    <input type="text" class="form-control" list="countries" id="country" name="country" placeholder="Type to search..." aria-describedby="country_error">
                    <datalist id="countries">
                        @foreach($countries as $country)
                            <option value="{{ $country['name'] }}" data-iso="{{ $country['iso2'] }}" ></option>
                        @endforeach
                    </datalist>
                    @if ($errors->has('country'))
                        <small id="country_error" class="form-text text-danger">{{ $errors->first('country') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="state">Province/State (Required)</label>
                    <input type="text" class="form-control" list="states" id="state" name="state" placeholder="Type to search..." aria-describedby="state_error">
                    <datalist id="states">

                    </datalist>
                    @if ($errors->has('state'))
                        <small id="state_error" class="form-text text-danger">{{ $errors->first('state') }}</small>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary col-lg-12 text-white fw-bold">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('footer_scripts')
    $(document).ready(function(){

        // Hide at load page
        $("#institution_input").hide();

        // Conditional for display
        $('#education').on('change', function() {
            this.value == 1 ? $("#institution_input").show() :  $("#institution_input").hide();
        });

        $('#country').on('input', function(){

            // Get option from DOM
            var option = $('#countries [value="' + $(this).val() + '"]');

            // Check option is valid
            if(option.length == 1){
                console.log(option.data('iso'));
            }
        });
    });
@endsection
