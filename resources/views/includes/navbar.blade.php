<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('f/avatar/default.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, Nanda</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <ion-icon name="person-outline"></ion-icon>
                    Profile
                </a>
                <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
                    <ion-icon name="exit-outline"></ion-icon>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
