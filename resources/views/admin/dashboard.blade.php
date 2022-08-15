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
                        {{$data['postcount']}}
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Ressources</h2>
                    <h1 class="text-center">
                       {{$data['ressourcecount']}}
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Questions</h2>
                    <h1 class="text-center">
                       {{$data['questioncount']}}
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 my-3">
                <div class="bg-light shadow p-5">
                    <h2 class="text-center">Users</h2>
                    <h1 class="text-center">
                        {{$data['usercount']}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="row py-5">
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
                    @foreach ($data['posts'] as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td><img src="/images/{{ $post->img }}" height="70px" width="80px"></td>
                    <td>{{ $post->category->name ?? null }}</td>
                    <td>{{ $post->tag }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>
                        <div class="p-2">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{ $post->id }}"><i class="fas fa-trash-alt"></i></button>
                        </div >
                        {{-- delete modal --}}
                        <div id="delete_modal_{{ $post->id }}" class="modal fade" aria-labelledby="delete_modal_{{ $post->id }}" aria-hidden="true">
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
                                        <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST">
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
