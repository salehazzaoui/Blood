@extends('layouts.app')

@section('content')
   <section class="p-4">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 border p-4">
                <h3 class="text-center my-3">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="text-danger mx-2">Attension</span>
                </h3>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Your email is not verified yet ,
                      you should verify your email address
                      to allow you do this stuff.
                    </div>
                </div>
                <div class="d-flex justify-content-center align-item-center my-2">
                    <a href="/verification/resend" role="button" class="tooltip-test">Procced to verify</a>
                </div>
            </div>
        </div>
    </div>
   </section>
@endsection