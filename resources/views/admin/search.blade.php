@extends('layouts.admin')
@section('content')
   <section class="Donors mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Donors
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between my-3">
                <p>Result of search :</p>
                <a href="{{ route('admin.donor') }}" class="btn btn-light">Go Back</a>
            </div>
            <div class="row">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">blood</th>
                    <th scope="col">wilaya</th>
                    <th scope="col">commune</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $i => $user)
                        <tr id="cid{{$user->id}}">
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->blood_type }}</td>
                            <td>{{ $user->wilaya }}</td>
                            <td>{{ $user->commune }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="" class="btn btn-primary me-2">Edit</a>
                                    <button type="button" onclick="deleteUser(<?php echo $user->id; ?>)" class="btn btn-danger me-2">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <!--pagination-->
          </div>
        </div>
      </div>
     </div>
   </section>
@endsection