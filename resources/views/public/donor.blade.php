@extends('layouts.app')
@section('content')
<section class="p-4">
    <div class="container-fluid">
        <x-m-navmenu />
        <div class="row flex-nowrap">
            <x-navmenu />
            <!-- content -->
            <div class="col py-3">
                <div class="container mt-2">
                    <div class="card">
                        <div class="card-header">
                          Become a Donor
                        </div>
                        <div class="card-body">
                          <div class="row mb-3">
                              <div class="card p-4" id="alert">
                                  <div class="card-header"> Information </div>
                                  <div class="card-body">
                                      <form action="{{ route('updateDonor') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="wilaya" id="wilaya" class="form-select my-2">
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
                                        </select>
                                        <input type="submit" class="btn btn-primary" value="Save">
                                      </form>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection