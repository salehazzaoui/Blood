@extends('layouts.admin')
@section('content')
   <section class="Donors mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Admins
        </div>
        <div class="card-body">
          <div class="row mb-3">
              <div class="col-md">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#admin">
                    Add Admin
                </button>
              </div>
              <div class="col-md-8"></div>
          </div>
          <div class="row">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $i => $admin)
                        <tr id="cid{{$admin->id}}">
                            <th scope="row">{{$i++}}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>
                               <button type="button" onclick="deleteAdmin({{ $admin->id }})" class="btn btn-danger me-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
     </div>
   </section>
   <!-- Modals-->
   <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin.adminstrator') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control my-2" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control my-2" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control my-2" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control my-2" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control my-2" placeholder="Repeat Password">
            </div>
            <div class="d-grid">
                <input type="submit" value="Register" class="btn btn-dark my-2">
            </div>
        </form>
    </div>
    </div>
</div>
   <script type="text/javascript">
     function deleteAdmin(id)
        {
        if(confirm("Do you want to delete?"))
        {
            $.ajax({
                method:'DELETE',
                url: '/admin/adminstrator/'+id,
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