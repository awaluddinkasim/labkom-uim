<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <ion-icon name="grid-outline"></ion-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <ion-icon name="apps-outline"></ion-icon>
                    <span>Master Data</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Program Studi</a></li>
                    <li><a class="nav-link" href="#">Mata Kuliah</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::segment(2) == "akun" ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <ion-icon name="people-outline"></ion-icon>
                    <span>Akun</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::segment(3) == "dosen" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.akun', 'dosen') }}">Dosen</a></li>
                    <li class="{{ Request::segment(3) == "mahasiswa" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.akun', 'mahasiswa') }}">Mahasiswa</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="#">
                    <ion-icon name="receipt-outline"></ion-icon>
                    <span>Slip Pembayaran</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#">
                    <ion-icon name="settings-outline"></ion-icon>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
