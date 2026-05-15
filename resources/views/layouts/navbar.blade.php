<div class="d-flex align-items-center">
    <h5 class="mb-0 fw-semibold text-dark">@yield('page_title', 'Dashboard')</h5>
</div>

<div class="d-flex align-items-center">
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2 text-primary fw-bold" style="width: 35px; height: 35px;">
                {{ substr(Auth::user()->name ?? 'M', 0, 1) }}
            </div>
            <span class="fw-medium">{{ Auth::user()->name ?? 'Merchant' }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
            <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}"><i class="fas fa-user-circle me-2 text-muted"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
