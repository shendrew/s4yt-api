@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.includes.alerts')
        <!-- resource actions -->
        <div class="container content-section col-lg-10 offset-lg-1 mt-3 d-flex bd-highlight">
            @role('super_admin|admin')
                <a type="submit" class="btn btn-primary text-white col-3" href="{{ route('modal.create') }}">
                    <i class="fa fa-skull-crossbones"></i>
                    Create modal
                </a>
            @endrole
            </div>
        <!-- table -->
        <div class="container content-section mt-3 col-lg-10 offset-lg-1">
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Title</th>
                    <th scope="col" class="text-center">Content Type</th>
                    <th scope="col" class="text-center">Content</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($modals) > 0)
                    @foreach($modals as $modal)
                        <tr>
                            <td class="text-center">{{ explode('-',$modal->id)[0] }}</td>
                            <td class="text-center">{{ $modal->title }}</td>
                            <td class="text-center">{{ $modal->content_type }}</td>
                            <td class="text-center text-truncate" style="max-width:150px;">{{ $modal->content }}</td>
                            <td>
                                <div class="container d-flex justify-content-center">
                                    @role('super_admin|admin')
                                        <a type="submit" class="btn btn-primary ml-2 text-white ms-2" href="{{ route('modal.show', $modal->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a type="submit" class="btn btn-primary ml-2 text-white ms-2" href="{{ route('modal.edit', $modal->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('modal.destroy', $modal->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-2 text-white ms-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No modals found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <!-- pagination -->
            <div class="row col-lg-12 d-flex justify-content-center flex-nowrap mb-3">
                {{ $modals->links() }}
            </div>
        </div>
    </div>
@endsection
