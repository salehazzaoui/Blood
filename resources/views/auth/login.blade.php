@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 border p-4">
            <h3 class="text-center my-3">
                <i class="fas fa-sign-in-alt"></i>
                <span class="text-danger mx-2">Login</span>
            </h3>
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
        </div>
    </div>
</div>
@endsection