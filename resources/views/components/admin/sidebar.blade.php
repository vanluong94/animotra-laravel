<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="/logo.png" alt="Animotra" class="w-75">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manga Management
    </div>

    {{-- Manga --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mangaMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-book-open"></i>
            <span>Manga</span>
        </a>
        <div id="mangaMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-stream"></i> All Mangas</a>
                <a class="collapse-item" href="{{ route('admin.manga.add') }}"><i class="fas fa-plus-circle"></i> Create Manga</a>
            </div>
        </div>
    </li>

    {{-- Categories --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoriesMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-archive"></i>
            <span>Categories</span>
        </a>
        <div id="categoriesMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.collection.all', 'category') }}"><i class="fas fa-stream"></i> All Categories</a>
                <a class="collapse-item" href="{{ route('admin.collection.add', 'category') }}"><i class="fas fa-plus-circle"></i> Create Category</a>
            </div>
        </div>
    </li>

    {{-- Tags --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagsMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-tags"></i>
            <span>Tags</span>
        </a>
        <div id="tagsMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-stream"></i> All Tags</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-plus-circle"></i> Create Tag</a>
            </div>
        </div>
    </li>

    {{-- Authors --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#authorsMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-pen-nib"></i>
            <span>Authors</span>
        </a>
        <div id="authorsMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-stream"></i> All Authors</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-plus-circle"></i> Create Author</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site Management
    </div>

    {{-- Users --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersMenu"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>
        <div id="usersMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-users"></i> All Users</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-user-plus"></i> Create User</a>
            </div>
        </div>
    </li>

    {{-- Comments --}}
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-comments"></i>
            <span>Comments</span>
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