@extends('layouts.admin')
@section('content')
<section class="Donors mt-4">
    <div class="card" id="alert">
      <div class="card-header">
        Inboxings
      </div>
      <div class="card-body">
        <div class="row mb-3">
            <div class="col-md"></div>
            <div class="col-md-8">
              <form class="d-flex" action="" method="get">
                  @csrf 
                  <input class="form-control me-2" name="q" type="search" placeholder="Search" id="search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
        </div>
        <div class="row">
            <div class="list-group">
                @if ($contacts->count() > 0)
                    @foreach ($contacts as $contact)
                        @if ($contact->is_read == false)
                        <a href="{{ route('admin.inbox', $contact->id) }}" class="list-group-item list-group-item-action p-3 bg-light">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h3>{{ $contact->name }}</h3> 
                              <span class="text-secondary"> has sent to you message</span>
                            </div>
                            <div> {{ $contact->created_at->diffForHumans() }}</div>
                          </div> 
                        </a>
                        @else
                        <a href="{{ route('admin.inbox', $contact->id) }}" class="list-group-item list-group-item-action p-3">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h3>{{ $contact->name }}</h3> 
                              <span class="text-secondary"> has sent to you message</span>
                            </div>
                            <div> {{ $contact->created_at->diffForHumans() }}</div>
                          </div> 
                        </a>
                        @endif
                    @endforeach
                @else
                   <p class="text-center">Nothing is New</p> 
                @endif
            </div>
            {{ $contacts->links() }}
        </div>
      </div>
    </div>
   </div>
 </section>
@endsection