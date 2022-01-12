@section('pageTitle', 'Profile | Subscription List' )

<x-profile :user="$user">
    <section>
        <h1 class="h4 text-uppercase fw-bold">Subscription List</h1>
    
        <x-app.m-collections :mangas="$mangas" columnClass="col-md-4"></x-app.m-collections>
    </section>
</x-profile>