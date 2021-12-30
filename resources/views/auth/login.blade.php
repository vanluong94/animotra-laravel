@section('pageTitle', 'Login')
@section('bodyClass', 'bg-animotra')

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
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors :errors="$errors" />
                            
                            <form method="POST" action="{{ route('login') }}" class="user">

                                @csrf

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        placeholder="Enter Email Address..." 
                                        id="email" type="email" name="email" :value="old('email')" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="password" placeholder="Password" 
                                        type="password"
                                        name="password"
                                        required 
                                        autocomplete="current-password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                        <label class="custom-control-label" for="remember_me">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
    
        </div>
    
    </div>
</x-admin-layout>