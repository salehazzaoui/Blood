@extends('layouts.app')
@section('content')
<section class="p-4">
  <div class="card bg-light">
    <div class="card-body">
      <div class="row">
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliders as $i => $slider)
                    @if ($i == 0)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 0"></button>
                    @else
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i++}}" aria-label="Slide {{$i++}}"></button>
                    @endif
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($sliders as $i => $slider)
                    @if ($i == 0)
                    <div class="carousel-item active">
                        <img class="d-block w-100" style="height: 400px" src="{{ asset('/storage/uploads/slider/'. $slider->image ) }}" alt="{{ $slider->name }}">
                    </div>
                    @else
                    <div class="carousel-item">
                        <img class="d-block w-100" style="height: 400px" src="{{ asset('/storage/uploads/slider/'. $slider->image ) }}" alt="{{ $slider->name }}">
                      </div>
                    @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-4">
          <div class="text-center">
            <div class="h3 mb-3">
              <img class="img-thumbnail" src="{{ asset('/storage/uploads/can-donate.jpg' ) }}" alt="donate">
            </div>
            <p class="card-text h5 text-secondary">
              A single pint can save three lives, a single gesture can create a million smiles
            </p>
            @auth
              <a href="/donor" class="btn btn-danger">Become a Donor</a>
            @endauth
            @guest
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#donor">Become a Donor</button>
            @endguest
          </div>
        </div>
    </div>
    </div>
  </div>
</section>
<hr>
<section class="p-3">
    <header class="container">
        <form action="{{ route('search') }}" method="get">
          <div class="d-md-flex">
            <select name="wilaya" id="wilaya" class="form-select m-2">
              <option selected disabled>Select wilaya </option>
              @foreach ($wilayas as $wilaya)
                  <option >{{$wilaya->name}}</option>
              @endforeach
            </select>
            <select name="commune" id="commune" class="form-select m-2">
                <option selected disabled>Select Commune </option>
              </select>
              <select name="blood" class="form-select m-2" aria-label="Default select example">
                <option selected disabled>Blood Type </option>
                <option >O+</option>
                <option >O-</option>
                <option >AB+</option>
                <option >AB-</option>
                <option >A+</option>
                <option >A-</option>
                <option >B+</option>
                <option >B-</option>
              </select>
              <div class="d-grid">
                  <button type="submit" class="btn btn-danger ms-2">Search</button>
              </div>
          </div>

        </form>
    </header>
</section>
<hr>
<section class="container  d-none d-md-block">
  <table class="table table-striped table-hover shadow">
      <thead class="bg-danger text-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">blood</th>
            <th scope="col">wilaya</th>
            <th scope="col">commune</th>
            <th scope="col">contact time</th>
            <th scope="col">contact him</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $i => $user)
        <tr id="cid{{$user->id}}">
            <th scope="row">{{$i++}}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->blood_type }}</td>
            <td>{{ $user->wilaya }}</td>
            <td>{{ $user->commune }}</td>
            <td>{{ $user->contact_time }}</td>
            <td>
              <a href="{{ route('chat.index', $user->id) }}" class="btn btn-light btn-rounded">
                <i class="fas fa-comment text-danger"></i>
              </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{{ $users->links() }}</div>
</section>
<section class="p-3 d-md-none ">
  @foreach ($users as $i => $user)
  <div class="card my-3 p-3">
     <div class="row">
        <div class="col"><h4>Name :</h4></div>
        <div class="col">{{ $user->name }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Email :</h4></div>
        <div class="col">{{ $user->email }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Blood :</h4></div>
        <div class="col">{{ $user->blood_type }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Wilaya :</h4></div>
        <div class="col">{{ $user->wilaya }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Commune :</h4></div>
        <div class="col">{{ $user->commune }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Contact time :</h4></div>
        <div class="col">{{ $user->contact_time }}</div>
     </div>
     <div class="row">
        <div class="col"><h4>Message him :</h4></div>
        <div class="col">
            <a href="{{ route('chat.index', $user->id) }}" class="btn btn-light btn-rounded">
              <i class="fas fa-comment text-danger"></i>
            </a>
        </div>
     </div>
  </div>
  @endforeach
  <div class="text-center">{{ $users->links() }}</div>
</section>
 <!-- Modals-->
 <div class="modal fade" id="donor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-exclamation-triangle"></i>
          Plese Login to allow do this
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control my-2" placeholder="Email">
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
      <div class="modal-footer" style="justify-content: center !important">
        <a href="/register" role="button" class="tooltip-test">Do you have registered ?</a>
      </div>
    </div>
  </div>
</div>
@endsection