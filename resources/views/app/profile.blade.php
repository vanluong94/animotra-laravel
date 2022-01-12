@section('pageTitle', 'Profile' )

<x-profile :user="$user">
    <section class="mb-5">
    
        <x-alert-errors></x-alert-errors>
        <x-alert-success></x-alert-success>
    
        <h1 class="h4 text-uppercase fw-bold mb-3">Edit Your Information</h1>
    
        <form action="{{ route('profile.update') }}" method="POST">
    
            @csrf
    
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ $user->name }}" placeholder="Name" required>
                <label for="user_name">Name</label>
            </div>
    
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $user->email }}" required placeholder="Email Address">
                <label for="email">Email address</label>
            </div>
              
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="user_password" name="user_password" required placeholder="Password">
                <label for="user_password">Password</label>
            </div>
    
            <button type="submit" class="btn btn-primary text-uppercase">Save</button>
    
        </form>
    </section>
    
    <section>
        <h1 class="h4 text-uppercase fw-bold">Change Your Password</h1>
    
        <form action="{{ route('profile.password') }}" method="POST">
    
            @csrf
    
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="user_current_password" name="current_password" required placeholder="Current Password">
                <label for="user_current_password">Current Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="user_new_password" name="new_password" required placeholder="New Password">
                <label for="user_new_password">New Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="user_new_password_confirm" name="new_password_confirmation" required placeholder="New Password Confirm">
                <label for="user_new_password_confirm">Confirm Password</label>
            </div>
    
            <button type="submit" class="btn btn-primary text-uppercase">Save</button>
    
        </form>
    </section>
</x-profile>