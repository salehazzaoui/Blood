@extends('layouts.admin')
@section('content')
   <section class="Donors mt-4">
      <div class="card" id="alert">
        <div class="card-header">
          Sliders
        </div>
        <div class="card-body">
          <div class="row mb-3">
              <div class="col-md">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#slider">
                    Add slider
                </button>
              </div>
              <div class="col-md-8"></div>
          </div>
          <div class="row">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($sliders->count() > 0)
                        @foreach ($sliders as $i => $slider)
                        <tr id="cid{{$slider->id}}">
                            <th scope="row">{{$i++}}</th>
                            <td>
                                <img class="rounded-1 w-25" src="{{ asset('/storage/uploads/slider/'. $slider->image ) }}" alt="{{ $slider->name }}">
                            </td>
                            <td>{{ $slider->name }}</td>
                            <td>
                               <button type="button" onclick="deleteSlider({{ $slider->id }})" class="btn btn-danger me-2">Delete</button>
                            </td>
                        </tr>
                       @endforeach  
                    @else
                        <tr>
                            <th scope="row">0</th>
                            <td> Nothing found </td>
                        </tr>
                    @endif
                </tbody>
              </table>
          </div>
        </div>
      </div>
     </div>
   </section>
   <!-- Modals-->
   <div class="modal fade" id="slider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-dark text-light">
        <h5 class="modal-title" id="exampleModalLabel">Slider</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin.slider') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control my-2" placeholder="Name">
            </div>
            <div class="mb-3">
                <input class="form-control" name="image" type="file" id="formFile image">
            </div>
            <div class="d-grid">
                <input type="submit" value="Submit" class="btn btn-dark my-2">
            </div>
        </form>
    </div>
    </div>
</div>
   <script type="text/javascript">
     function deleteSlider(id)
        {
        if(confirm("Do you want to delete?"))
        {
            $.ajax({
                method:'DELETE',
                url: '/admin/slider/'+id,
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