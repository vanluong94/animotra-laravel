@section('pageTitle', 'Verify Email')
@section('bodyClass', 'bg-animotra')

<x-admin-layout>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-6">

                <div class="logo text-center my-5">
                    <img src="/logo.png" alt="Animotra">
                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Verify Email</h1>

                                <p class="mb-4">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>

                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 alert alert-info">
                                        A new verification link has been sent to the email address you provided during registration.
                                    </div>
                                @endif
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="POST" action="{{ route('verification.send') }}" class="mb-2">
                                        @csrf
                        
                                        <div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Resend Verification Email
                                            </button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('logout') }}" class="mb-2">
                                        @csrf
                        
                                        <button type="submit" class="btn btn-secondary btn-user btn-block">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                

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