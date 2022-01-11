<!-- HEADER -->
<header id="site-header">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- HEADER LEFT -->
                <div class="header-left col">
                    <div class="header-left-row d-flex justify-content-start">
                        <div class="header-search-form">
                            <form action="">
                                <div class="search-input-wrapper">
                                    <input class="search-input" type="text" placeholder="Search Keywords">
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
                        <div class="header-btn-group header-notifications position-relative">
                            <a class="header-btn notification-btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notificationsDropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge">3</span>
                            </a>

                            <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="notificationsDropdown">
                                <h6 class="dropdown-header">
                                    Notifications Center
                                </h6>
                                <a class="dropdown-item notification-item" href="#">
                                    <div>
                                        <div class="notification-datetime">December 12, 2019</div>
                                        <span class="notification-content">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item notification-item" href="#">
                                    <div>
                                        <div class="notification-datetime">December 12, 2019</div>
                                        <span class="notification-content">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item notification-item" href="#">
                                    <div>
                                        <div class="notification-datetime">December 12, 2019</div>
                                        <span class="notification-content">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item dropdown-footer" href="#">Show All Alerts</a>
                            </div>
                        </div>

                        <div class="header-btn-group header-user position-relative">
                            <a class="header-btn user-btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userMenuDropdownBtn">
                                <i class="fas fa-user"></i>
                            </a>

                            <div class="dropdown-list dropdown-menu shadow animated--grow-in" aria-labelledby="userMenuDropdownBtn" id="userMenuDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-heart"></i>Favorite
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-history"></i>History
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-id-card"></i>Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
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