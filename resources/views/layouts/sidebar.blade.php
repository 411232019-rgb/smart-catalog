<nav class="sc-nav">
    <a href="{{ route('dashboard') }}" class="sc-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i> Dashboard
    </a>

    <div class="sc-nav-label">Master Data</div>

    <a href="{{ route('kategori.index') }}" class="sc-nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
        <i class="fas fa-tags"></i> Kategori
    </a>
    <a href="{{ route('produk.index') }}" class="sc-nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
        <i class="fas fa-box-open"></i> Produk
    </a>
    <a href="{{ route('profile.index') }}" class="sc-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Merchant
    </a>

    <div class="sc-nav-label">Transaksi</div>

    <a href="{{ route('transaksi.index') }}" class="sc-nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i> Data Transaksi
    </a>

    <div class="sc-nav-label">Laporan</div>

    <a href="{{ route('laporan.produk') }}" class="sc-nav-link {{ request()->routeIs('laporan.produk') ? 'active' : '' }}">
        <i class="fas fa-file-alt"></i> Laporan Produk
    </a>
    <a href="{{ route('laporan.transaksi') }}" class="sc-nav-link {{ request()->routeIs('laporan.transaksi') ? 'active' : '' }}">
        <i class="fas fa-file-invoice-dollar"></i> Laporan Transaksi
    </a>

    <div class="sc-nav-label">Pengaturan</div>

    <a href="{{ route('profile.index') }}" class="sc-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <i class="fas fa-user-cog"></i> Profile
    </a>
    <form action="{{ route('logout') }}" method="POST" id="sidebar-logout-form">
        @csrf
        <a href="#" onclick="document.getElementById('sidebar-logout-form').submit()" class="sc-nav-link text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </form>
</nav>
