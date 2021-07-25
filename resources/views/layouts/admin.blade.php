<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blood Bank</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href=""><i class="fas fa-user-tie mx-2"></i>Admin Panel</a>
                @auth
                <div class="dropdown">
                    <button class="btn btn-default text-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user h5"></i>
                      {{auth()->user()->name}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="/admin/dashboard">Dashboard</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.settings', auth()->user()->id) }}">Settings</a></li>
                      <li>
                          <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-default"value="Logout">
                         </form>
                      </li>
                    </ul>
                </div>
                @endauth
            </div>
          </nav>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li>
                                <a href="/admin/dashboard" class="nav-link px-0 align-middle text-light">
                                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> 
                                </a>
                            </li>
                            <li>
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-light">
                                    <i class="fas fa-user-md h4"></i> <span class="ms-1 d-none d-sm-inline">Donor</span></a>
                                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="{{ route('admin.donor') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">View</span></a>
                                    </li>
                                    <li>
                                        <a href="/admin/adonors" class="nav-link px-0"> <span class="d-none d-sm-inline">Add</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/admin/adminstrator" class="nav-link px-0 align-middle text-light">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Admins</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.inboxing') }}" class="nav-link px-0 align-middle text-light">
                                    <i class="fas fa-envelope-open-text h4"></i> 
                                    <span class="ms-1 d-none d-sm-inline">
                                        Inboxing
                                        @if (Route::is('admin.dashboard') && $contactsIsNotRead->count() > 0)
                                        <span class="mx-2 badge rounded-pill bg-danger">
                                            {{$contactsIsNotRead->count()}} 
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-light">
                                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('admin.sliders') }}" class="nav-link px-0 align-middle text-light">
                                    <i class="fas fa-sliders-h h4"></i> <span class="ms-1 d-none d-sm-inline">Slider</span> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col py-3">
                    <div class="container mt-2">
                        @include('inc.message')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="{{asset('js/index.js')}}"></script>
    </body>
</html>
