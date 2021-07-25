@extends('layouts.admin')
@section('content')
<section class="Donors mt-4">
    <div class="text-end mb-2">
        <a href="{{ route('admin.inboxing') }}" class="btn btn-light">Go Back</a>
    </div>
    <div class="card" id="alert">
      <div class="card-header">
        Inboxing
      </div>
      <div class="card-body">
          <h3>I'm {{ $contact->name }}</h3>
          <p>My phone number is {{ $contact->phone}}</p>
          <p> {{ $contact->message}} </p>
      </div>
    </div>
   </div>
 </section>
@endsection