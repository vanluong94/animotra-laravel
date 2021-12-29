@section('bodyClass')
bg-animotra
@endsection

@section('pageTitle')
Register
@endsection

<x-admin-layout>
    <div class="container">

        <div class="row justify-content-center">
    
            <div class="col-xl-6 col-lg-12 col-md-6">

                <div class="logo text-center my-5">
                    <img src="logo.png" alt="Animotra">
                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors :errors="$errors" />

                            <form class="user" method="POST" action="{{ route('register') }}">

                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" :value="old('email')" required
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Password"
                                            name="password"
                                            required autocomplete="new-password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                        id="password_confirmation" name="password_confirmation" required placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
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