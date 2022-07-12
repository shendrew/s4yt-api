@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.includes.alerts')
        <!-- resource actions -->
        <div class="container content-section col-lg-10 offset-lg-1 mt-3 d-flex bd-highlight">
            @role('super_admin|admin')
                <a type="submit" class="btn btn-primary text-white col-3" href="{{ route('player.create') }}">
                    <i class="fa fa-skull-crossbones"></i>
                    Create player
                </a>
            @endrole
            </div>
        <!-- table -->
        <div class="container content-section mt-3 col-lg-10 offset-lg-1">
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($players) > 0)
                    @foreach($players as $player)
                        <tr>
                            <td>{{ explode('-',$player->id)[0] }}</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->email }}</td>
                            <td>
                                <div class="container d-flex justify-content-center">
                                    @role('super_admin|admin')
                                        <a type="submit" class="btn btn-primary text-white" href="{{ route('player.edit', $player->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('player.destroy', $player->id) }}" method="POST">
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
                        <td colspan="4" class="text-center">No players found</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <!-- pagination -->
            <div class="row col-lg-12 d-flex justify-content-center flex-nowrap mb-3">
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection
