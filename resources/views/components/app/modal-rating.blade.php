<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rateModalLabel">Give it stars</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Auth::guest())
                    <p>Login is required to rate this manga</p>
                @else
                    <div class="text-center">
                        <input id="userRating" name="userRating" class="kv-ltr-theme-fas-star rating-loading" data-size="md" value="{{ $rating }}">
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                @if (Auth::guest())
                    <a type="button" class="btn btn-primary" href="{{ route('login') }}">Login</a>
                @endif
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>