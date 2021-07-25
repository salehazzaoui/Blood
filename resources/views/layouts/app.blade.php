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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
            <div class="container">
              <a class="navbar-brand" href="#"><i class="fas fa-hospital-user"></i>Blood Bank</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse ms-4" id="navmenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    @if (Route::is('home'))
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    @else  
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                    @endif
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item">
                    @if (Route::is('contact.index'))
                    <a class="nav-link active" href="/contact">Contact us</a>
                    @else  
                    <a class="nav-link" href="/contact">Contact us</a>
                    @endif
                  </li>
                </ul>
                @guest
                <div class="auth">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#login">
                        Login
                    </button>
                    <a href="{{ route('register') }}" class="btn btn-light">Sign Up</a>
                </div>
                @endguest
                @auth
                <div class="dropdown">
                    <button class="btn btn-default text-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user h5"></i>
                      {{auth()->user()->name}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      @if (auth()->user()->is_admin == true)
                      <li><a class="dropdown-item" href="/admin/dashboard">dashboard</a></li>
                      @else
                      <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">dashboard</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      @endif
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
            </div>
          </nav>
          <section class="p-4">
            <div class="container my-3">
              @include('inc.message')
            </div>
          </section>
          @yield('content')
          <footer class="footer bg-danger text-light p-2 mt-4">
            <div class="container">
              <div class="d-md-flex">
                <p>2020-2021&copy;</p> 
             </div>
            </div>
          </footer>
          <!-- Modals-->
            <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control my-2" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control my-2" placeholder="Password">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="flexCheckDefault"> Remember</label>
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Login" class="btn btn-danger my-2">
                        </div>
                    </form>
                    <div class="d-flex justify-content-center align-item-center my-2">
                        <a href="{{ route('password.request') }}" role="button" class="tooltip-test" title="Popover title" data-bs-content="Popover body content is set in this attribute.">Forgot Password ?</a>
                    </div>
                    <p class="text-center">Or</p>
                    <div class="d-flex flex-column justify-content-center">
                        <a href="{{ route('register.google') }}" class="btn btn-danger my-2">
                          <i class="fab fa-google-plus-g"></i>
                            Login with Google
                        </a>
                        <a href="{{ route('register.facebook') }}" class="btn btn-primary my-2">
                          <i class="fab fa-facebook-f"></i>
                            Login with Facebook
                        </a>
                    </div>
                </div>
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="{{asset('js/index.js')}}"></script>
    </body>
</html>
