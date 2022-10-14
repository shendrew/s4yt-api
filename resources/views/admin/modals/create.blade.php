@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- title -->
        <div class="container content-section">
            <h2 class="col-lg-12 text-center">New Modal</h2>
        </div>
        <!-- resource actions -->
        <div class="container content-section col-lg-10 offset-lg-1 mt-3">
            <a href="{{ route('modal.index') }}" class="btn btn-primary text-white">
                <i class="fas fa-backward mr-2"></i>
                Go back
            </a>
        </div>
        <!-- form -->
        <div class="container content-section mt-3">
            <form action="{{ route('modal.store') }}" method="POST" autocomplete="off" class="col-lg-6 offset-lg-3 mb-5">
                @csrf
                <div class="form-group mt-2">
                    <label for="title">Title (Required)</label>
                    <input type="text" class="form-control" id="title" name="title">
                    @if ($errors->has('title'))
                        <small id="title_error" class="form-text text-danger">{{ $errors->first('title') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="content_type">Content Type (Required)</label>
                    <input type="text" class="form-control" id="content_type" name="content_type">
                    @if ($errors->has('content_type'))
                        <small id="content_type_error" class="form-text text-danger">{{ $errors->first('content_type') }}</small>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label for="content_type">Content (Required)</label>
                    <input type="text" class="form-control" id="content" name="content">
                    @if ($errors->has('content'))
                        <small id="content_error" class="form-text text-danger">{{ $errors->first('content') }}</small>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary col-lg-12 text-white fw-bold">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
