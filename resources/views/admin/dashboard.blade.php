@extends('admin.layout.app')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Posts publied</h2>
                    <h1 class="text-center">
                        22
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Ressources</h2>
                    <h1 class="text-center">
                       13
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Questions</h2>
                    <h1 class="text-center">
                       21
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Users</h2>
                    <h1 class="text-center">
                        33
                    </h1>
                </div>
            </div>
        </div>
        <div class="row py-5">
            {{-- @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif --}}
        <table class="table table-striped table-bordered shadow">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {{-- @if(!($user->isAdmin))
                        <form action="{{ route('setAdmin',$user->id)}}" method="POST">
                        @csrf
                        @method('put')
                        </form>
                    @else
                        <span class="bg-success p-2 text-white px-4">Admin</span>
                    @endif --}}
                        <button class="btn btn-danger bg-danger" type="submit">Set Admin</button>
                </td>
            @endforeach
            </tr>
            </tbody>
        </table>
        <hr>
        <div class="mt-5">
            <h3 class="p-3 shadow">Latest posts publied</h3>
            <table class="table table-striped table-bordered shadow my-5">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Publied By</th>
                    <th scope="col">Publied at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                <tr>
                    <td>1</td>
                    <td>First post</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod delectus commodi, eveniet blanditiis pariatur minus exercitationem expedita totam</td>
                    <td></td>
                    <td>Mouhcine</td>
                    <td>Two hour ago</td>
                    <td>
                        {{-- @if(!($user->isAdmin))
                            <form action="{{ route('setAdmin',$user->id)}}" method="POST">
                            @csrf
                            @method('put')
                            </form>
                        @else
                            <span class="bg-success p-2 text-white px-4">Admin</span>
                        @endif --}}
                            <button class="btn btn-danger bg-danger" type="submit">Set Admin</button>
                    </td>

                @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
