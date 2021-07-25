@extends('layouts.app')
@section('content')
<section class="p-4">
    <div class="container mt-4">
        <form action="{{ route('register') }}" method="post" class="border p-3">
              @csrf
              <h3 class="text-center my-3">
                  <i class="fas fa-user-plus"></i>
                  <span class="text-danger mx-2">Register</span>
              </h3>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="name" class="form-control my-2" placeholder="Username">
                      </div>
                      <div class="form-group"> 
                          <input type="email" name="email" class="form-control my-2" placeholder="Email">
                      </div>
                      <div class="form-group">
                          <input type="text" name="phone" class="form-control my-2" placeholder="Phone Number">
                      </div>
                      <div class="form-group">
                          <input type="password" name="password" class="form-control my-2" placeholder="Password">
                      </div>
                      <div class="form-group">
                          <input type="password" name="password_confirmation" class="form-control my-2" placeholder="Repeat Password">
                      </div>
                  </div>
                  <div class="col">
                      <h4 class="text-center text-secondary">Or social login</h4>
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
                      <!--<select name="wilaya" id="wilaya" class="form-select my-2">
                          <option selected disabled>Select wilaya </option>
                          @foreach ($wilayas as $wilaya)
                              <option >{{$wilaya->name}}</option>
                          @endforeach
                        </select>
                        <select name="commune" id="commune" class="form-select my-2">
                            <option selected disabled>Select Commune </option>
                        </select>
                        <select name="blood_type" class="form-select my-2" aria-label="Default select example">
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
                        <select name="contact_type" class="form-select my-2" aria-label="Default select example">
                          <option selected disabled>Contact Type </option>
                          <option >SMS</option>
                          <option >Calls</option>
                          <option >SMS+Calls</option>
                        </select>
                        <select name="contact_time" class="form-select my-2" aria-label="Default select example">
                          <option selected disabled>Contact Time </option>
                          <option >24h/24h</option>
                          <option >From 8am to 3pm</option>
                          <option >From 3pm to 11pm</option>
                        </select> -->
                  </div>
              </div>
              <div class="d-flex justify-content-end">
                  <input type="submit" class="btn btn-danger" value="Register">
              </div>
        </form>
    </div>
</section>
@endsection