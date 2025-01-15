<div class="mobile-bottom mobile-bottom position-relative z-999">
    <div class="nav">
        <div class="nav-slot bg-white round-top-left">
            <a href="{{ url('/') }}" class="nav-link active text-center">
                <i class="mdi mdi-home fa-fw"></i>
                Home
            </a>
        </div>
        <div class="nav-slot bg-white">
            <a href="{{ url('properties') }}" class="nav-link">
                <i class="mdi mdi-hospital-building fa-fw"></i>
                Properties
            </a>
        </div>
        <div class="nav-slot curve">
            <a href="{{ url('account/properties/create') }}" role="button" class="floating-button">
                <i class="mdi mdi-plus"></i>
            </a>
        </div>
        <div class="nav-slot bg-white">
            <a href="{{ url('projects') }}" class="nav-link">
                <i class="mdi mdi-office-building fa-fw"></i>
                Projects
            </a>
        </div>
        <div class="nav-slot bg-white round-top-right">
            @if (auth()->check())
                <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                    <i class="mdi mdi-account fa-fw"></i>
                    Account
                </a>
            @elseif(auth('account')->check())
                <a href="{{ route('user.dashboard') }}" class="nav-link">
                    <i class="mdi mdi-account fa-fw"></i>
                    Account
                </a>
            @else
                <a href="{{ route('user.login') }}" class="nav-link">
                    <i class="mdi mdi-account fa-fw"></i>
                    Login
                </a>
            @endif
        </div>
    </div>
</div>
