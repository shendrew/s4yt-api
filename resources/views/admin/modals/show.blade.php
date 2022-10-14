@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- resource actions -->
        <div class="container content-section col-lg-10 offset-lg-1 mt-3">
            <a href="{{ route('modal.index') }}" class="btn btn-primary text-white">
                <i class="fas fa-backward mr-2"></i>
                Go back
            </a>
        </div>
        <!-- table -->
        <div class="container content-section mt-3 col-lg-10 offset-lg-1">
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th scope="col">Fields</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col">Title</td>
                        <td scope="col">{{ $modal->title }}</td>
                    </tr>
                    <tr>
                        <td scope="col">Slug</td>
                        <td scope="col">{{ $modal->slug }}</td>
                    </tr>
                    <tr>
                        <td scope="col">Content Type</td>
                        <td scope="col">{{ $modal->content_type }}</td>
                    </tr>
                    <tr>
                        <td scope="col">Content</td>
                        <td scope="col">{{ $modal->content }}</td>
                    </tr>
                </tbody>
        </div>
    </div>
@endsection
