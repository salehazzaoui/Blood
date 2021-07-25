@extends('layouts.admin')
@section('content')
   <section>
    <div class="row text-center g-4">
        <div class="col-md-12 col-lg-4">
          <div class="card bg-secondary text-light">
            <div class="card-body text-center">
              <div class="h3 mb-3">
                <i class="fas fa-user"></i>
              </div>
              <h4 class="card-title mb-3">Donors</h4>
              <p class="card-text">
                {{ $donors->count() }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md">
          <div class="card bg-dark text-light p-2">
            <div class="card-body text-center">
              <table class="table table-dark table-striped table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Blood</th>
                    <th scope="col">A+</th>
                    <th scope="col">B+</th>
                    <th scope="col">A-</th>
                    <th scope="col">B-</th>
                    <th scope="col">AB+</th>
                    <th scope="col">AB-</th>
                    <th scope="col">O+</th>
                    <th scope="col">O-</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Count</th>
                    <td>{{ $Ap->count() }}</td>
                    <td>{{ $An->count() }}</td>
                    <td>{{ $Bp->count() }}</td>
                    <td>{{ $Bn->count() }}</td>
                    <td>{{ $ABp->count() }}</td>
                    <td>{{ $ABn->count() }}</td>
                    <td>{{ $Op->count() }}</td>
                    <td>{{ $On->count() }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
   </section>
   <section class="Donors mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Donors
        </div>
        <div class="card-body">
          <div class="row">
            <div class="table-responsive">
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
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
              {{ $users->links() }}
          </div>
        </div>
      </div>
     </div>
   </section>
@endsection