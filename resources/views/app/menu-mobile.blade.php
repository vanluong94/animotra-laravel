<div class="mobile-menu menu-collapse off-canvas">
    <div class="close-nav">
        <button class="menu_icon__close">
            <span></span> <span></span>
        </button>
    </div>

    <nav class="off-menu">

        <form method="get" action="{{ route('manga.all') }}" class="px-4">
            <div class="search-input-wrapper m-auto">
                <input class="search-input d-block w-100" type="text" name="s" placeholder="Search Keywords">
            </div>
        </form>

		<nav class="navbar navbar-expand-lg">
            <ul id="mobile-menu" class="navbar-nav menu w-100 justify-content-center">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">Home Page</a></li>
                <li class="nav-item {{ request()->routeIs('manga.all') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.all') }}">All Mangas</a></li>
                <li class="nav-item {{ request()->routeIs('manga.bestSelling') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.bestSelling') }}">Best Selling Mangas</a></li>
                <li class="nav-item {{ request()->routeIs('manga.newest') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.newest')}}">Newest Mangas</a></li>
                <li class="nav-item {{ request()->routeIs('manga.latest') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.latest')}}">Latest Mangas</a></li>
                <li class="nav-item {{ request()->routeIs('manga.topRated') ? 'active' : '' }}"><a class="nav-link" href="{{ route('manga.topRated')}}">Top Rated Mangas</a></li>
            </ul>
        </nav>
    </nav>
</div>

<script>
    jQuery(".off-canvas ul > li.menu-item-has-children").addClass("hiden-sub-canvas");
    jQuery(".off-canvas ul >li.menu-item-has-children").append('<i class="fa fa-caret-right" aria-hidden="true"></i>');

    var menu_open = jQuery('.menu_icon__open');
    var menu_close = jQuery('.menu_icon__close');
    var menu_slide = jQuery('.off-canvas');
    var menu_sign_in = jQuery('.mobile-menu .btn-active-modal');
    
    menu_open.on('click', function () {
        menu_open.addClass('active');
        menu_slide.addClass('active');
        jQuery('body').addClass('open_canvas');
    });
    
    menu_close.on('click', function (e) {
        e.preventDefault();
        menu_open.removeClass('active');
        menu_slide.removeClass('active');
        jQuery('body').removeClass('open_canvas');
    });
    
    menu_sign_in.on('click', function (e) {
        e.preventDefault();
        menu_open.removeClass('active');
        menu_slide.removeClass('active');
        jQuery('body').removeClass('open_canvas');
    });
    
    jQuery(".off-canvas ul >li.menu-item-has-children > i").on('click', function () {
        var jQuerythis = jQuery(this).parent("li");
        jQuerythis.toggleClass("active").children("ul").slideToggle();
        return false;
    });
    jQuery(document).on(" touchend click", function (e) {
        if (!jQuery(e.target).hasClass('menu_icon__open') && !jQuery(e.target).closest('.off-canvas').hasClass('active')) {
            menu_slide.removeClass('active');
            menu_open.removeClass("active");
            jQuery('body').removeClass('open_canvas');
        }
    });
</script>