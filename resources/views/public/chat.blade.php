@extends('layouts.app')
@section('content')
<section class="p-4">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 border p-4">
                <h3 class="text-center my-3">
                    <i class="fas fa-comment"></i>
                    <span class="text-danger mx-2">Contact Donor</span>
                </h3>
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <i class="bi bi-question-circle me-3 h3"></i>
                    <div>
                      If donor accept your request, he will call you in your phone number,
                      or send to you an email
                    </div>
                </div>
                <form action="{{ route('chat') }}" method="post">
                    @csrf
                    <div class="form-group"> 
                        <input type="email" readonly name="recipient_email" class="form-control my-2" value="{{ $donor->email }}">
                    </div>
                    <textarea name="body" class="form-control my-2" placeholder="Message"></textarea>
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="btn btn-danger" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection