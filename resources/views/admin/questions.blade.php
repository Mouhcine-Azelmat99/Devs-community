@extends('admin.layout.app')

@section('title')
    Admin Questions
@endsection

@section('content')
    <div class="container">
        <nav class="bg-light shadow p-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item fs-4"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active fs-4" aria-current="page">Questions</li>
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
                <h3>All Questions</h3>
        
            <table class="table table-striped table-bordered shadow my-5">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Publied By</th>
                    <th scope="col">Publied at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->title }}</td>
                    <td>{{ $question->body }}</td>
                    <td>{{ $question->user->username }}</td>
                    <td>{{$question->created_at->diffForHumans()}}</td>
                    <td>
                        <div class="p-2">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{ $question->id }}"><i class="fas fa-trash-alt"></i></button>
                        </div >
                        {{-- delete modal --}}
                        <div id="delete_modal_{{ $question->id }}" class="modal fade" aria-labelledby="delete_modal_{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-confirm">
                                <div class="modal-content">
                                    <div class="modal-header flex-column">
                                        <h4 class="modal-title w-100">Are you sure?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.questions.destroy',$question->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
