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
                    <label for="education">Education</label>
                    <select class="form-select form-control" aria-label="Default select example" id="education" name="education">
                        <option value="0" selected>Choose an option</option>
                        @foreach($educations as $education)
                            <option value="{{ $education->id }}">{{ $education->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('education'))
                        <small id="education_error" class="form-text text-danger">{{ $errors->first('education') }}</small>
                    @endif
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
                    <select class="form-select form-control" aria-label="Default select example" id="grade" name="grade">
                        <option value="0" selected>Choose an option</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
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
                    <label for="state">Province/State (Required) <i class="fas fa-spinner fa-spin-pulse" id="state-spinner"></i></label>
                    <select class="form-select form-control" id="state" name="state" aria-describedby="state_error" disabled>
                        <option  value="0" selected>Select a province/state...</option>
                    </select>
                    @if ($errors->has('state'))
                        <small id="state_error" class="form-text text-danger">{{ $errors->first('state') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="city">City (Required) <i class="fas fa-spinner fa-spin-pulse" id="city-spinner"></i></label>
                    <select class="form-select form-control" id="city" name="city" aria-describedby="city_error" disabled>
                        <option  value="0" selected>Select a city...</option>
                    </select>
                    @if ($errors->has('city'))
                        <small id="city_error" class="form-text text-danger">{{ $errors->first('city') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="role">Role (Required)</label>
                    <select class="form-select form-control" aria-label="Default select example" id="role" name="role">
                        <option value="0" selected>Choose an option</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <small id="role_error" class="form-text text-danger">{{ $errors->first('role') }}</small>
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
        $("#state-spinner").hide();
        $("#city-spinner").hide();

        // Conditional for display
        $('#education').on('change', function() {
            this.value == 1 ? $("#institution_input").show() :  $("#institution_input").hide();
        });

        $('#country').on('input', function(){

            // Get option from DOM
            const option = $('#countries [value="' + $(this).val() + '"]');
            // Constants definitions
            const stateSpinner = $("#state-spinner");
            const stateSelect = $("#state");
            const citySelect = $("#city");
            // Disabled state input
            stateSelect.prop('disabled', true);
            citySelect.prop('disabled', true);
            // Remove potential children except first
            $("#state option").slice(1).remove();
            $("#city option").slice(1).remove();

            // Check option is valid
            if(option.length == 1){

                // Show loader
                stateSpinner.show();
                // Get data
                const ciso = option.data('iso');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:"{{ route('location.states') }}",
                    data:{ciso:ciso},
                    success:function(data){
                        let states = data.data.states;
                        $.each(states, function(i, state) {
                            stateSelect.append('<option value="' + state.iso2 + '">' +  state.name + '</option>');
                        });
                        // Hide spinner
                        stateSpinner.hide();
                        // Enable select
                        stateSelect.prop('disabled', false);
                    }
                });
            }
        });

        $('#state').on('change', function(){

            // Get option from DOM
            const option = $('#countries [value="' + $("#country").val() + '"]');
            // Constants definitions
            const citySpinner = $("#city-spinner");
            const citySelect = $("#city");
            // Disabled city input
            citySelect.prop('disabled', true);
            // Remove potential children except first
            $("#city option").slice(1).remove();
            const state = $(this);

            if(state.val() !== "0") {

                // Show loader
                citySpinner.show();
                // Get data
                const ciso = option.data('iso');
                const siso = state.val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:"{{ route('location.cities') }}",
                    data:{ciso:ciso, siso:siso},
                    success:function(data){
                        let cities = data.data.cities;
                        $.each(cities, function(i, city) {
                        citySelect.append('<option value="' + city.id + '">' +  city.name + '</option>');
                        });
                        // Hide spinner
                        citySpinner.hide();
                        // Enable select
                        citySelect.prop('disabled', false);
                    }
                });
            }
        });
    });
@endsection
