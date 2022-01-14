@section('pageTitle', 'Confirm Password')
@section('bodyClass', 'bg-animotra')

<x-admin-layout>
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-6">

                <div class="logo text-center my-5">
                    <img src="/logo.png" alt="Animotra">
                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Confirm Password</h1>
                                <p class="mb-4">This is a secure area of the application. Please confirm your password before continuing.</p>
                            </div>
                            
                            <!-- Validation Errors -->
                            <x-auth-validation-errors :errors="$errors" />
                            
                            <form class="user" method="POST" action="{{ route('password.confirm') }}">

                                @csrf

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                    id="password" class="block mt-1 w-full" name="password" 
                                        required autocomplete="current-password"
                                        placeholder="Password...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Confirm
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Create an Account!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-admin-layout>
