<div class="row justify-content-center">
    <div class="col-md-8 col-sm-12">

        <x-alert-errors></x-alert-errors>

        <div class="card text-center">
            <div class="card-body p-5">

                @php
                    $insufficient = Auth::user()->balance < $chapter->coin;
                @endphp

                <h5 class="card-title">Premium Chapter</h5>
                <p class="card-text">This is a Premium Chapter, please purchase it to access</p>
                <p class="card-text">Your balance doesn't have enough tokens to purchase this chapter</p>

                <form action="{{ $chapter->getPurchaseUrl() }}" method="POST" id="purchaseForm" class="d-flex flex-column align-items-center">

                    <button class="btn btn-primary mb-2" type="submit" {{ $insufficient ? 'disabled' : '' }}>
                        <img src="/img/token.png" alt="token" class="token-icon">Buy it with <strong>{{ $chapter->coin }} tokens</strong>
                    </button>

                    @if ($insufficient)
                        <a href="{{ route('profile.topup.page') }}" class="btn btn-primary mb-2">
                            <img src="/img/tokens.png" alt="token" class="token-icon">Topup
                        </a>
                    @endif

                    <a href="{{ route('manga.view', $chapter->manga->slug) }}" class="btn bg-secondary text-white rounded-pill mb-2">Go Back</a>

                    @csrf

                </form>

            </div>
        </div>
    </div>
</div>