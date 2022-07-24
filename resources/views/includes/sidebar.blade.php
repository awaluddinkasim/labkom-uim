<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Lab</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <ion-icon name="grid"></ion-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) == "informasi" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.informasi') }}">
                    <ion-icon name="newspaper"></ion-icon>
                    <span>Informasi</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ Request::segment(2) == "master" ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <ion-icon name="apps"></ion-icon>
                    <span>Master Data</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::segment(3) == "fakultas" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.master', 'fakultas') }}">Fakultas</a></li>
                    <li class="{{ Request::segment(3) == "prodi" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.master', 'prodi') }}">Program Studi</a></li>
                    <li class="{{ Request::segment(3) == "praktikum" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.master', 'praktikum') }}">Praktikum</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::segment(2) == "akun" ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <ion-icon name="people"></ion-icon>
                    <span>Akun</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::segment(3) == "dosen" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.akun', 'dosen') }}">Dosen</a></li>
                    <li class="{{ Request::segment(3) == "mahasiswa" ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.akun', 'mahasiswa') }}">Mahasiswa</a></li>
                </ul>
            </li>
            <li class="{{ Request::segment(2) == "slip" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.slip') }}">
                    <ion-icon name="receipt"></ion-icon>
                    <span>Slip Pembayaran</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) == "pengaturan" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pengaturan') }}">
                    <ion-icon name="settings"></ion-icon>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
