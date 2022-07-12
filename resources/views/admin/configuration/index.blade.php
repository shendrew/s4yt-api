@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.includes.alerts')
        <!-- table -->
        <div class="container content-section mt-3 col-lg-10 offset-lg-1">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Key</th>
                        <th scope="col">Value</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($configs) > 0)
                        @foreach($configs as $config)
                            <tr>
                                <td>{{ $config->id }}</td>
                                <td>{{ $config->key }}</td>
                                <td>{{ $config->value }}</td>
                                <td>
                                    <div class="container">
                                        <a href="{{ route('configuration.edit',$config->id) }}" class="btn btn-primary text-white">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <!-- pagination -->
            <div class="row col-lg-12 d-flex justify-content-center flex-nowrap mb-3">
                {{ $configs -> links() }}
            </div>
        </div>
    </div>
@endsection
