<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        
    </li>

    <!-- Nav Item - Alerts -->
    

    

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
        
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
    aria-labelledby="userDropdown">
    <a class="dropdown-item" href="#">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
    </a>
    <a class="dropdown-item" href="#">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
    </a>
    <a class="dropdown-item" href="#">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
        Activity Log
    </a>
    <div class="dropdown-divider"></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
        onclick="event.preventDefault();
        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>
</div>
</li>

</ul>

</nav>
                <!-- End of Topbar -->