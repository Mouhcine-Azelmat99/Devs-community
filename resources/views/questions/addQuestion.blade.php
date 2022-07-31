<div class="col-lg-4" id="sidebar">
    <div class="addPost">
        @if ($errors)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
        @endif
    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text"name="title" class="form-control" placeholder="Titre *" required>
        <textarea name="body" placeholder="Content ..." id="body" class="form-control"></textarea>
        <input type="file" name="image" class="form-control" placeholder="Upload image">
        <div class="d-grid gap-2">
            <button type="submit" class="btn ">Ajouter</button>
        </div>
    </form>
    </div>
</div>
