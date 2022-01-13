@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/home.css">
@endpush

@section('bodyClass', 'home home-header-extend ' . (Auth::check() ? 'has-user' : ''))

@section('pageTitle', 'Home' )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">

        <!-- HOME SLIDER -->
		<section class="home-section home-featured-slider">
			<div class="container">
				<x-collection-featured-slider :mangas="$featuredMangas" title="Featured"></x-collection-featured-slider>
			</div>
		</section>

		<!-- LATEST SLIDER -->
		<section class="home-section home-top-rated-slider">
			<div class="container">
				<x-collection-slider :mangas="$latestMangas" title="Latest Mangas"></x-collection-slider>
			</div>
		</section>

        <!-- BEST SELLING SLIDER -->
		<section class="home-section home-latest-slider">
			<div class="container">
				<x-collection-slider :mangas="$bestSellingMangas" title="Best Selling"></x-collection-slider>
			</div>
		</section>
        
		<!-- SUBSCRIPTION BANNER -->
		<section class="home-section home-subscription-banner">
			<div class="container">
				<div class="subscription text-uppercase text-white pt-5 pb-4">
					<div class="row">
						<div class="col-md-3 col-sm-12 mb-3 d-flex flex-column align-items-start position-relative">
							<span class="heading-underline h3">Subscribe</span>
							<span class="h6 font-weight-normal">to get favorit anime</span>
							<span class="heading-underline h6 font-weight-light">to get the newest episodes</span>
							<i class="fas fa-bell icon-background"></i>
						</div>
						<div class="col-md-3 col-sm-12 mb-3 d-flex flex-column">
							<div class="subscription-logo">
								<i class="fas fa-user-plus"></i>
							</div>
							<div class="subscription-step d-flex">
								<div class="subscription-step-left d-flex flex-column">
									<span class="h4 heading-underline">01</span>
									<small>step</small>
								</div>
								<div class="subscription-step-right d-flex flex-column">
									<span class="h4">Signup</span>
									<small>create an account</small>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-12 mb-3 d-flex flex-column">
							<div class="subscription-logo">
								<i class="fas fa-bars"></i>
							</div>
							<div class="subscription-step d-flex">
								<div class="subscription-step-left d-flex flex-column">
									<span class="h4 heading-underline">02</span>
									<small>step</small>
								</div>
								<div class="subscription-step-right d-flex flex-column">
									<span class="h4">Choose</span>
									<small>Choose your anime</small>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-12 mb-3 d-flex flex-column">
							<div class="subscription-logo">
								<i class="fas fa-bell"></i>
							</div>
							<div class="subscription-step d-flex">
								<div class="subscription-step-left d-flex flex-column">
									<span class="h4 heading-underline">03</span>
									<small>step</small>
								</div>
								<div class="subscription-step-right d-flex flex-column">
									<span class="h4">Subscribe</span>
									<small>Click to subscribe</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- TOP RATED SLIDER -->
		<section class="home-section home-latest-slider">
			<div class="container">
				<x-collection-slider :mangas="$topRatedMangas" title="Top Rated Mangas"></x-collection-slider>
			</div>
		</section>

    </main>

    <x-app.footer></x-app.footer>   
</x-app-layout>
    