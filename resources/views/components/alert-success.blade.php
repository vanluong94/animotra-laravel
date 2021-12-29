@if (Session::has('successMsg'))
    <div class="alert alert-success mb-4 border-left-success">
        <p class="mb-0">{{ Session::get('successMsg') }}</p>
    </div>
@endif