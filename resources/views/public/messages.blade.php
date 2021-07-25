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
                          Requests
                        </div>
                        <div class="card-body">
                           @if ($messages->count() > 0)
                               @foreach ($messages as $message)
                                  <div class="card my-2">
                                      <div class="card-body">
                                          <p class="card-text">{{ $message->body }}</p>
                                      </div>
                                  </div>
                               @endforeach
                           @else
                               <div class="card-body">
                                    <p class="card-text">You do not have any request yet.</p>
                                </div>
                           @endif
                           <div class="text-center">{{ $messages->links() }}</div>
                        </div>
                      </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection