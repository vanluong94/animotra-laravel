<ul class="navbar-nav bg-gradient-primary bg-image-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <img src="/logo.png" alt="Animotra" class="w-75">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Website</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manga Management
    </div>

    {{-- Manga --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.manga.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#mangaMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-book-open"></i>
            <span>Manga</span>
        </a>
        <div id="mangaMenu" class="collapse {{ request()->routeIs('admin.manga.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.manga.all') ? 'active' : '' }}" href="{{ route('admin.manga.all') }}"><i class="fas fa-stream"></i> All Mangas</a>
                <a class="collapse-item {{ request()->routeIs('admin.manga.add') ? 'active' : '' }}" href="{{ route('admin.manga.add') }}"><i class="fas fa-plus-circle"></i> Create Manga</a>
            </div>
        </div>
    </li>

    @foreach (config('other.manga.collections') as $type => $typeData )
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/collection/' . $type . '/*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#{{ $type . 'Menu' }}"
                aria-expanded="{{ request()->is('admin/collection/' . $type . '/*') ? 'true' : 'false' }}" aria-controls="collapseTwo">
                <i class="{{ $typeData['icon'] }}"></i>
                <span>{{ $typeData['label']['plural'] }}</span>
            </a>
            <div id="{{ $type . 'Menu' }}" class="collapse {{ request()->is('admin/collection/' . $type . '/*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin/collection/' . $type . '/all') ? 'active' : '' }}" href="{{ route('admin.collection.all', $type) }}"><i class="fas fa-stream"></i> All {{ $typeData['label']['plural'] }}</a>
                    <a class="collapse-item {{ request()->is('admin/collection/' . $type . '/add') ? 'active' : '' }}" href="{{ route('admin.collection.add', $type) }}"><i class="fas fa-plus-circle"></i> Create {{ $typeData['label']['singular'] }}</a>
                </div>
            </div>
        </li>
    @endforeach

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site Management
    </div>

    {{-- Users --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/user/*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#usersMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>
        <div id="usersMenu" class="collapse {{ request()->routeIs('admin.user.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('admin.user.all') ? 'active' : '' }}" href="{{ route('admin.user.all') }}"><i class="fas fa-users"></i> All Users</a>
                <a class="collapse-item {{ request()->routeIs('admin.user.add') ? 'active' : '' }}" href="{{ route('admin.user.add') }}"><i class="fas fa-user-plus"></i> Create User</a>
            </div>
        </div>
    </li>


    {{-- Transactions --}}
    <li class="nav-item {{ request()->routeIs('admin.transaction.all') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transaction.all') }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Transactions</span>
        </a>
    </li>

    {{-- Comments --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-comments"></i>
            <span>Comments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.settings') }}">
            <i class="fas fa-cogs"></i>
            <span>Settings</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Business Management
    </div>

    {{-- Reports --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-trophy"></i>
            <span>Best sold</span>
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-chart-bar"></i>
            <span>Analytistic</span>
        </a>
        
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>