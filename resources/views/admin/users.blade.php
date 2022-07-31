@extends('admin.layout.app')

@section('title')
    Admin Users
@endsection

@section('content')
    <div class="container">
        <nav class="bg-light shadow p-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item fs-4"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active fs-4" aria-current="page">Posts</li>
            </ol>
          </nav>
        <div class="row py-5">
            <script>
                @if(Session::has('msg'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "timeOut": "10000",
                    "extendedTimeOut": "5000",

                }
                toastr.success("{{ Session::get('msg') }}");
                @endif
            </script>
        <div class="mt-5">
                <h3>posts publied</h3>
        
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
                        @if(!($user->isAdmin))
                            <form action="{{ route('admin.setAdmin',$user->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-danger bg-danger" type="submit">Set Admin</button>
                            </form>
                        @else
                            <span class="bg-success p-2 text-white px-4">Admin</span>
                        @endif
                    </td>
                @endforeach
                </tr>
                </tbody>
        </table>
        </div>
    </div>
    </div>
@endsection
