@section('pageTitle', 'Forgot Password')

@section('bodyClass')
bg-animotra
@endsection

<x-admin-layout>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-6">

                <div class="logo text-center my-5">
                    <img src="logo.png" alt="Animotra">
                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                    and we'll send you a link to reset your password!</p>
                            </div>
                            
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            
                            <!-- Validation Errors -->
                            <x-auth-validation-errors :errors="$errors" />
                            
                            <form class="user" method="POST" action="{{ route('password.email') }}">

                                @csrf

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                    id="email" class="block mt-1 w-full" name="email" :value="old('email')" 
                                        required autofocus
                                        placeholder="Enter Email Address...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Email Password Reset Link
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