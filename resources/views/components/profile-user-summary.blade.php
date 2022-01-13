@php
    $user = Auth::user();
@endphp

<div class="user-summary d-flex align-items-center">
    <div class="user-avatar rounded-circle overflow-hidden position-relative" id="userAvatar">

        <img src="{{ $user->getAvatar() }}" alt="">

        <form action="{{ route('profile.avatar.upload') }}" method="post" id="avatarForm" enctype="multipart/form-data">
            <label class="btn" id="changeAvtBtn" for="avatarFile">Change</label>
            <input type="file" name="avatar_file" id="avatarFile">
            @csrf
        </form>

    </div>
    <div class="user-names flex-grow-1 text-center">
        <div class="user-display-name mb-2">
            {{ $user->name }}
        </div>
        <div class="user-balance mb-2">
            <div class="btn btn-primary btn-sm px-3">
                <img src="/img/tokens.png" alt="token" class="token-icon">
                <span><strong>{{ $user->balance }}</strong> tokens</span>
            </div>
        </div>
        <div class="user-login-name mb-2">
            {{ '@' . $user->username }}
        </div>
    </div>
</div>

<script>
    jQuery(function($){

        let $form       = $('#avatarForm');
        let $changeBtn  = $('#changeAvtBtn');
        let $file       = $('#avatarFile');
        let $userAvatar = $('#userAvatar');

        $file.on('change', function(){
            if(this.files) {
                $form.submit();                
            }
        })

    })
</script>