@section('pageTitle', 'Profile | Read Later' )

<x-profile :user="$user">
    <section>
        <h1 class="h4 text-uppercase fw-bold mb-4">Read Later List</h1>
    
        <x-app.m-collections :mangas="$mangas" columnClass="col-md-4"></x-app.m-collections>
    </section>
</x-profile>