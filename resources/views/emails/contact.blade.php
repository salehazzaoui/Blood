<body>
    <h3>Hello I'm {{$contact->name}}</h3>
    <p>This my phone number {{$contact->phone}} if you want to call me</p>
    <div class="card">
        <div class="card-body">
            <p>{{$contact->message}}</p>
        </div>
    </div>
    <h5>I hope that was useful</h5>
</body>