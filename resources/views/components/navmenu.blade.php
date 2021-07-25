<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white d-none d-lg-block">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="list-group">
            <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action">
                <i class="fas fa-tachometer-alt h-3"></i>
                Dashboard
            </a>
            <a href="/donor" class="list-group-item list-group-item-action">
                <i class="fas fa-stethoscope h-3"></i>
                Donor
            </a>
            <a href="{{ route('donor.request') }}" class="list-group-item list-group-item-action">
                <i class="fas fa-envelope-square"></i>
                Request
            </a>
        </div>
    </div>
</div>