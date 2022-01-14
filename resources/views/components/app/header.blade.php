<!-- HEADER -->
<header id="site-header">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- HEADER LEFT -->
                <div class="header-left col">
                    <div class="header-left-row d-flex justify-content-start">
                        <div class="header-search-form">
                            <form method="get" action="{{ route('manga.all') }}">
                                <div class="search-input-wrapper">
                                    <input class="search-input" type="text" name="s" placeholder="Search Keywords">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- HEADER CENTER -->
                <div class="header-center col">
                    <div class="header-center-row d-flex justify-content-center">
                        <div class="site-logo">
                            <a href="{{ route('home') }}"><img src="/logo.png" alt="Animatra"></a>
                        </div>
                    </div>
                </div>
                <!-- HEADER RIGHT -->
                <div class="header-right col">
                    <div class="header-right-row d-flex justify-content-end">

                        {{-- NOTIFICATIONS --}}
                        @auth
                            <div class="header-btn-group header-notifications position-relative">

                                <a class="header-btn notification-btn nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notificationsDropdown">
                                    <i class="fas fa-bell"></i>
                                    @if (($unread = Auth::user()->unreadNotifications->count()))
                                        <span class="badge">{{ $unread }}</span>
                                    @endif  
                                </a>

                                <div class="dropdown-list dropdown-menu shadow animated--grow-in bg-primary" aria-labelledby="notificationsDropdown">
                                    <h6 class="dropdown-header text-white">
                                        Notifications Center
                                    </h6>

                                    <div class="dropdown-body bg-white">
                                        @php
                                            $noties = Auth::user()->notifications()->limit(10)->get();
                                        @endphp
                                        @if ($noties->isNotEmpty())
                                            @foreach ($noties as $noti)
                                                <a class="dropdown-item d-flex align-items-center notification-item {{ $noti->isRead() ? '' : 'unread' }}" href="{{ $noti->getReadUrl() }}">
                                                    <div>
                                                        <div class="notification-datetime">{{ $noti->created_at->format( 'M d, Y' ) }}</div>
                                                        <span class="notification-content">{!! $noti->content !!}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="dropdown-item text-center text-opacity-50 text-dark">You have no notification</div>
                                        @endif
                                    </div>
                                    <a class="dropdown-item dropdown-footer bg-white" href="{{ route('profile.notifications') }}">Show All Alerts</a>
                                </div>

                            </div>
                        @endauth

                        {{-- USER MENU --}}
                        <div class="header-btn-group header-user position-relative">

                            <button type="button" class="header-btn user-btn nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userMenuDropdownBtn">
                                <i class="fas fa-user"></i>
                            </button>
                            
                            <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="userMenuDropdownBtn" id="userMenuDropdown">

                                @auth
                                    <div class="dropdown-item p-4 d-flex flex-column align-items-center user-balance-item">
                                        <div class="mb-2 w-50 rounded-circle overflow-hidden">
                                            <img src="{{ Auth::user()->getAvatar() }}" alt="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="mb-2">
                                            <span>{{ '@' . Auth::user()->username }}</span>
                                        </div>
                                        <div class="mb-2 fs-6">
                                            <img src="/img/tokens.png" alt="token" class="token-icon me-2">
                                            <span><strong>{{ Auth::user()->balance }}</strong> tokens</span>
                                        </div>
                                        <a href="{{ route('profile.topup.page') }}" class="btn btn-primary btn-sm d-block w-75">
                                            TOPUP
                                        </a>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('profile.favorites') }}">
                                        <i class="fas fa-heart"></i>Favorites
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.subscriptions') }}">
                                        <i class="fas fa-bookmark"></i>Subscriptions
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-id-card"></i>Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Log out</button>
                                    </form>
                                @endauth

                                @guest
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i>Login
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i>Register
                                    </a>
                                @endguest
                                
                            </div>
                        </div>

                        {{-- MOBILE MENU TOGGLE BTN --}}
                        <div class="header-btn-group header-mobile-menu-btn">
                            <div class="header-btn">
                                <button type="button" class="menu_icon__open">
                                    <span></span> <span></span> <span></span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <ul id="main-menu" class="navbar-nav menu w-100 justify-content-center">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">Home Page</a></li>
                    <li class="nav-item {{ request()->routeIs('manga.all') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.all') }}">All Mangas</a></li>
                    <li class="nav-item {{ request()->routeIs('manga.bestSelling') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.bestSelling') }}">Best Selling Mangas</a></li>
                    <li class="nav-item {{ request()->routeIs('manga.newest') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.newest')}}">Newest Mangas</a></li>
                    <li class="nav-item {{ request()->routeIs('manga.latest') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.latest')}}">Latest Mangas</a></li>
                    <li class="nav-item {{ request()->routeIs('manga.topRated') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.topRated')}}">Top Rated Mangas</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>