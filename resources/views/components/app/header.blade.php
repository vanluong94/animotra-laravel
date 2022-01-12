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

                        @auth
                            <div class="header-btn-group header-notifications position-relative">

                                <a class="header-btn notification-btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notificationsDropdown">
                                    <i class="fas fa-bell"></i>
                                    @if (($unread = Auth::user()->unreadNotifications->count()))
                                        <span class="badge">{{ $unread }}</span>
                                    @endif  
                                </a>

                                <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="notificationsDropdown">
                                    <h6 class="dropdown-header">
                                        Notifications Center
                                    </h6>

                                    @foreach (Auth::user()->notifications()->limit(10)->get() as $noti)
                                        <a class="dropdown-item d-flex align-items-center notification-item {{ $noti->isRead() ? '' : 'unread' }}" href="{{ $noti->getReadUrl() }}">
                                            <div>
                                                <div class="notification-datetime">{{ $noti->created_at->format( 'M d, Y' ) }}</div>
                                                <span class="notification-content">{!! $noti->content !!}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                    <a class="dropdown-item dropdown-footer" href="{{ route('profile.notifications') }}">Show All Alerts</a>
                                </div>

                            </div>
                        @endauth

                        <div class="header-btn-group header-user position-relative">
                            <a class="header-btn user-btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userMenuDropdownBtn">
                                <i class="fas fa-user"></i>
                            </a>

                            <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="userMenuDropdownBtn" id="userMenuDropdown">
                                <div class="dropdown-item p-4 d-flex flex-column align-items-center user-balance-item" href="#">
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
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt"></i>Log out
                                </a>
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
                <ul id="main-menu" class="navbar-nav menu w-100 justify-content-between">
                    <li class="nav-item active"><a class="nav-link" href="homepage.html">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="manga.html">Manga Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="chapter.html">Chapter Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="search.html">Search Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">All Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile-favorite.html">Favorite</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile-update.html">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="404.html">404 Page</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>