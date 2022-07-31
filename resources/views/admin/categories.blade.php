@extends('admin.layout.app')

@section('title')
    Admin Categories
@endsection

@section('content')
    <div class="container">
        <nav class="bg-light shadow p-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item fs-4"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active fs-4" aria-current="page">Categories</li>
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
            <div class="d-flex justify-content-between p-3 shadow">
                <h3>All Caetegories</h3>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#add_category">
                    Add Category
                </button>
                 <!-- Modal -->
                 <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        @if ($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                        @endif
                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirme</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <table class="table table-striped table-bordered shadow my-5">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="{{ route('admin.categories.delete',$category->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
