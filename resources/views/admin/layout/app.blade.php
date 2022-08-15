<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fontawesome  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- css file -->
    {{-- <link rel="stylesheet"href="{{ mix('/css/app.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title')</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
  <body style="overflow-x: visible">
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-primary text-white">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-warning text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">ADMIN Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start text-white" id="menu">
                    <li class="nav-item my-3">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white align-middle px-0">
                            <i class="fas fa-home"></i> <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ route('admin.users') }}" class="nav-link text-white px-0 align-middle">
                            <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Users</span> </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link text-white px-0 align-middle">
                            <i class="fas fa-paste"></i> <span class="ms-1 d-none d-sm-inline">Posts</span> </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ route('admin.categories') }}" class="nav-link text-white px-0 align-middle">
                            <i class="fas fa-bars"></i> <span class="ms-1 d-none d-sm-inline">Catgeories</span> </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ route('admin.questions') }}" class="nav-link text-white px-0 align-middle">
                            <i class="fas fa-question-circle"></i> <span class="ms-1 d-none d-sm-inline">Questions</span> </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ route('admin.ressources') }}" class="nav-link text-white px-0 align-middle">
                            <i class="fas fa-chalkboard-teacher"></i> <span class="ms-1 d-none d-sm-inline">Ressources</span> </a>
                    </li>
                </ul>
            </ul>
            </div>
        </div>
        <div class="col p-0">
            <div class="d-flex justify-content-end p-4 shadow">
                <a href="#" class="nav-link">Logout</a>
                <a href="#" class="nav-link">{{ Auth::user()->username }}</a>
            </div>
            <div class="content py-3">
                 @yield('content')
            </div>
        </div>
    </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
  </body>
</html>
