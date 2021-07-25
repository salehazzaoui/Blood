@extends('layouts.app')
@section('content')
   <section class="container mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Donors
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between my-3">
                <p>Result of search :</p>
                <a href="/" class="btn btn-light">Go Back</a>
            </div>
            <div class="row">
              @if ($users->count() > 0)
                <table class="table table-striped table-hover">
                  <thead class="bg-danger text-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">blood</th>
                        <th scope="col">wilaya</th>
                        <th scope="col">commune</th>
                        <th scope="col">contact time</th>
                        <th scope="col">contact him</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $i => $user)
                    <tr id="cid{{$user->id}}">
                        <th scope="row">{{$i++}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->blood_type }}</td>
                        <td>{{ $user->wilaya }}</td>
                        <td>{{ $user->commune }}</td>
                        <td>{{ $user->contact_time }}</td>
                        <td>
                          <a href="{{ route('chat.index', $user->id) }}" class="btn btn-light btn-rounded">
                            <i class="fas fa-comment text-danger"></i>
                          </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                  <h2 class="text-center">No Donor Found</h2>
              @endif
          </div>
        </div>
      </div>
     </div>
   </section>
@endsection