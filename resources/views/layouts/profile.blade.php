@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/profile.css">
@endpush

@section('bodyClass', 'profile-page has-page-header')

<x-app-layout>
    <x-app.header></x-app.header>

    <!-- BODY -->
    <main id="site-body">
        <div class="page">

            <!-- PAGE HEADER -->
            <div class="page__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <ul id="profile-menu">
                                <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                                    <a href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li class="{{ request()->routeIs('profile.topup.page') ? 'active' : '' }}">
                                    <a href="{{ route('profile.topup.page') }}">Topup</a>
                                </li>
                                <li class="{{ request()->routeIs('profile.logs') ? 'active' : '' }}">
                                    <a href="{{ route('profile.logs') }}">Token Logs</a>
                                </li>
                                <li class="{{ request()->routeIs('profile.notifications') ? 'active' : '' }}">
                                    <a href="{{ route('profile.notifications') }}">Notifications</a>
                                </li>
                                <li class="{{ request()->routeIs('profile.comments') ? 'active' : '' }}">
                                    <a href="{{ route('profile.comments') }}">Comments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="page__content">
                <div class="container">
                    <div class="row">

                        <!-- SIDEBAR -->
                        <div class="sidebar-col col-md-4">
                            <div class="sidebar-col__content sidebar--offset">
                                <!-- USER INFO -->
                                <section class="user-info mb-5 bg-white">
                                    <div class="m-table">

                                        <div class="m-table__row">
                                            <div class="user-summary d-flex align-items-center">
                                                <div class="user-avatar rounded-circle overflow-hidden">
                                                    <img src="{{ $user->getAvatar() }}" alt="">
                                                </div>
                                                <div class="user-names flex-grow-1 text-center">
                                                    <div class="user-display-name mb-2">
                                                        {{ $user->name }}
                                                    </div>
                                                    <div class="user-balance mb-2">
                                                        <div class="btn btn-primary btn-sm px-3">
                                                            <img src="/img/tokens.png" alt="token" class="token-icon">
                                                            <span><strong>{{ $user->balance }}</strong> tokens</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="m-table__row">
                                            <span class="m-table__row-label">Email Address:</span>
                                            <span class="m-table__row-value">{{ $user->email }}</span>
                                        </div>
                                        <div class="m-table__row has-link">
                                            <a href="{{ route('profile.comments')}}">
                                                <span class="m-table__row-label">Comments:</span>
                                                <span class="m-table__row-value">{{ $user->comments->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="m-table__row has-link">
                                            <a href="{{ route('profile.favorites')}}">
                                                <span class="m-table__row-label">Favorites:</span>
                                                <span class="m-table__row-value">{{ $user->favoriteMangas->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="m-table__row has-link">
                                            <a href="{{ route('profile.readLater')}}">
                                                <span class="m-table__row-label">Read Later:</span>
                                                <span class="m-table__row-value">{{ $user->readLaterMangas->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="m-table__row has-link">
                                            <a href="{{ route('profile.subscriptions')}}">
                                                <span class="m-table__row-label">Subscriptions:</span>
                                                <span class="m-table__row-value">{{ $user->subscribedMangas->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="m-table__row">
                                            <span class="m-table__row-label">Registered at:</span>
                                            <span class="m-table__row-value">{{ $user->created_at }}</span>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>

                        <!-- MAIN COL -->
                        <div class="main-col col-md-8">

                            <div class="main-col__content">

                                {{ $slot }}

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </main>

    <x-app.footer></x-app.footer>   
</x-app-layout>
