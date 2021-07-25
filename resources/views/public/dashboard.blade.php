@extends('layouts.app')
@section('content')
<section class="p-4">
    <div class="container-fluid">
        <x-m-navmenu />
        <div class="row flex-nowrap">
            <x-navmenu />
            <!-- content -->
            <div class="col">
                <div class="container mt-2">
                    <div class="card">
                        <div class="card-header">
                          Settings
                        </div>
                        <div class="card-body">
                          <div class="row mb-3">
                              <div class="card p-4" id="alert">
                                  <div class="card-header"> Information </div>
                                  <div class="card-body">
                                      <form id="info">
                                        @csrf
                                        <div class="form-group my-3">
                                            <label for="name">Name *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="phone">Phone *</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Save">
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="card p-4" id="alert-p">
                                <div class="card-header"> Password </div>
                                <div class="card-body">
                                    <form id="pass" >
                                        @csrf
                                        <div class="form-group my-3">
                                            <label for="current_password">Your Password *</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="password">New Password *</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="password_confirmation">Repeat Password *</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                        </div>
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