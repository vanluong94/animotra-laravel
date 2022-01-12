@php
    use \App\Models\Manga;

    $new_mangas     = Manga::queryNewest()->limit(3)->get();
    $popular_mangas = Manga::queryPopular()->limit(3)->get();
    $random_mangas  = Manga::queryRandom()->limit(3)->get();
    $best_selling   = Manga::queryBestSelling()->first();
@endphp

<!-- FOOTER -->
<footer id="site-footer" class="text-white">
    <div class="container">
        <div class="footer-widgets">
            <div class="row">
                <div class="footer-column col">
                    <div class="widget">
                        <div class="widget__title">
                            <div class="m-heading ">
                                <h4 class="m-heading__content">New Mangas</h4>
                            </div>
                        </div>
                        <div class="widget__content">
                            <x-collection-small-thumb :mangas="$new_mangas"></x-collection-small-thumb>
                        </div>
                    </div>
                </div>
                <div class="footer-column col">
                    <div class="widget">
                        <div class="widget__title">
                            <div class="m-heading ">
                                <h4 class="m-heading__content">Popular Mangas</h4>
                            </div>
                        </div>
                        <div class="widget__content">
                            <x-collection-small-thumb :mangas="$popular_mangas"></x-collection-small-thumb>
                        </div>
                    </div>
                </div>
                <div class="footer-column col">
                    <div class="widget">
                        <div class="widget__title">
                            <div class="m-heading ">
                                <h4 class="m-heading__content">Random Mangas</h4>
                            </div>
                        </div>
                        <div class="widget__content">
                            <x-collection-small-thumb :mangas="$random_mangas"></x-collection-small-thumb>
                        </div>
                    </div>
                </div>
                <div class="footer-column col">
                    <div class="m-heading widget__title"><span class="m-heading__content">Manga Of The Day</span></div>
                    <div class="widget__content">
                        <a 
                            href="{{ $best_selling->getViewUrl() }}"
                            class="d-block w-100" 
                            style="
                                padding-top: 100%; 
                                background-image: url({{ $best_selling->getThumbnailUrl() }});
                                background-position: center;
                                background-size: cover;
                            "
                        ></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="footer-menu py-2">
            <div class="navbar navbar-expand-lg text-uppercase">
                <ul class="navbar-nav menu d-flex align-items-center justify-content-between">
                    <li class="nav-item"><a class="nav-link" href="#">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link"  href="#">Online Anime</a></li>
                    <li class="nav-item"><a class="nav-link"  href="#">Manga Reader</a></li>
                    <li class="nav-item"><a class="nav-link"  href="#">Anime Ovas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Home Page</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Online Anime</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Manga Reader</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Anime Ovas</a></li>
                </ul>
            </div>
        </div> --}}
    </div>		
</footer>

<!-- SUB FOOTER -->
<div id="site-sub-footer" class="text-white">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col">
                <div class="sub-footer-left text-start my-4">
                    <div class="h6 font-weight-normal text-uppercase">Made with a lot of passion</div>
                </div>
            </div>
            <div class="col">
                <div class="sub-footer-right text-end my-4">
                    <div class="h6 font-weight-normal">Copyright @2021</div>
                </div>
            </div>
        </div>
    </div>
</div>