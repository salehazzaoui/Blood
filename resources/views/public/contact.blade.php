@extends('layouts.app')
@section('content')
<section class="p-4">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 border p-4">
                <h3 class="text-center my-3">
                    <i class="fas fa-id-card"></i>
                    <span class="text-danger mx-2">Contact us</span>
                </h3>
                <form action="{{ route('contact') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control my-2" placeholder="Name">
                    </div>
                    <div class="form-group"> 
                        <input type="email" name="email" class="form-control my-2" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control my-2" placeholder="Phone Number">
                    </div>
                    <textarea name="message" class="form-control my-2" placeholder="Message"></textarea>
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-danger" value="Submit">
                    </div>
            </form>
            </div>
        </div>
    </div>
</section>
@endsection