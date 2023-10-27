<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Clinic</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link text-center" style="font-size: 30px">
                        <i class="fa-solid fa-house-medical-circle-check text-danger"></i>
                    </a>
                </li>
            </ul>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{route('admin#profile')}}" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>
                                    {{Auth::user()->name}}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#category')}}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>
                                    Disease Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#post')}}" class="nav-link">
                                <i class="fa-solid fa-user-pen"></i>
                                <p>
                                    Patient's Posts
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin#list')}}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    User List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route("admin#trend")}}" class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>
                                    Disease Lists
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="Post">
                                @csrf
                                <button class="btn bg-danger w-100" type="submit">
                                    <i class="fas fa-sign-out-alt"></i>

                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="container mt-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
