@extends('layouts.admin')
@section('content')
   <section class="Donors mt-4">
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
                        <input type="hidden" id="id" value="{{ $admin->id }}">
                        <div class="form-group my-3">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}">
                        </div>
                        <div class="form-group my-3">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $admin->email }}">
                        </div>
                        <div class="form-group my-3">
                            <label for="phone">Phone *</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $admin->phone }}">
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
                        <input type="hidden" id="uid" value="{{ $admin->id }}">
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
   </section>
   <script type="text/javascript">
     
     $(document).ready(function() {
        $('#info').on('submit', function(e){
            e.preventDefault();
            const id = $('#id').val();
            const name = $('#name').val();
            const email = $('#email').val();
            const phone = $('#phone').val();
            $.ajax({
                method:'PUT',
                url: '/admin/settings/information/'+id,
                data:{
                    name:name,
                    email:email,
                    phone:phone,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json'
            }).done(function(data){
                if(data.success){
                    var success = $('<div class="alert alert-success" id="myAlert" role="alert"></div>').text(data.success);
                    $("#alert").before(success); 
                    setTimeout(function(){
                       $("#myAlert").remove()
                    }, 3000);
                }else{
                    var errors = $('<div class="alert alert-danger" id="myAlert" role="alert"></div>');
                    $("#alert").before(errors); 
                    $.each(data.errors, function(key, value){
                  	   errors.append('<p>'+value+'</p>');
                    });
                    setTimeout(function(){
                       $("#myAlert").remove()
                    }, 3000);
                }
            });
        })
        // password update
        $('#pass').on('submit', function(e){
            e.preventDefault();
            const id = $('#uid').val();
            const current_password = $('#current_password').val();
            const password = $('#password').val();
            const password_confirmation = $('#password_confirmation').val();
            $.ajax({
                method:'PUT',
                url: '/admin/settings/password/'+id,
                data:{
                    current_password:current_password,
                    password:password,
                    password_confirmation:password_confirmation,
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json'
            }).done(function(data){
                if(data.success){
                    var success = $('<div class="alert alert-success" id="myAlert" role="alert"></div>').text(data.success);
                    $("#alert-p").before(success); 
                    setTimeout(function(){
                       $("#myAlert").remove()
                    }, 3000);
                }else{
                    var errors = $('<div class="alert alert-danger" id="myAlert" role="alert"></div>');
                    $("#alert-p").before(errors); 
                    $.each(data.errors, function(key, value){
                  	   errors.append('<p>'+value+'</p>');
                    });
                    setTimeout(function(){
                       $("#myAlert").remove()
                    }, 3000);
                }
            });
        })
     })
     
   </script>
@endsection