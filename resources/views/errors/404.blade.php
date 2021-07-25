@extends('layouts.app')

@section('content')
   <section class="p-4">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 border p-4">
                <h3 class="text-center my-3">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="text-danger mx-2">404 page not found</span>
                </h3>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      this page does not exist.
                    </div>
                </div>
                <div class="d-flex justify-content-center align-item-center my-2">
                    <a href="/" role="button" class="tooltip-test">Go to homme page</a>
                </div>
            </div>
        </div>
    </div>
   </section>
@endsection