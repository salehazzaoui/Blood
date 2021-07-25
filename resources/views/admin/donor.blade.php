@extends('layouts.admin')
@section('content')
   <section class="Donors mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Donors
        </div>
        <div class="card-body">
          <div class="row mb-3">
              <div class="col-md">
                  <a href="/admin/adonors" class="btn btn-success">Add Donor</a>
              </div>
              <div class="col-md-8">
                <form class="d-flex" action="{{ route('admin.search') }}" method="get">
                    @csrf 
                    <input class="form-control me-2" name="q" type="search" placeholder="Search" id="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
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
                              <button type="button" onclick="deleteUser({{ $user->id }})" class="btn btn-danger me-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $users->links() }}
          </div>
        </div>
      </div>
     </div>
   </section>
   <script type="text/javascript">
     function deleteUser(id)
        {
        if(confirm("Do you want to delete?"))
        {
            $.ajax({
                method:'DELETE',
                url: '/admin/donor/'+id,
                data:{
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json'
            }).done(function(data){
                //console.log(data);
                var success = $('<div class="alert alert-success" id="myAlert" role="alert"></div>').text(data.success);
                $("#cid"+id).remove();
                $("#alert").before(success); 
                setTimeout(function(){
                    $("#myAlert").remove()}
                    , 3000);
            });
        }
        }
   </script>
@endsection