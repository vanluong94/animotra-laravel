@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/user.css">
@endpush

{{-- USER CARD --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
    </div>
    <div class="card-body">
        <form action="{{ isset( $id ) ? route('admin.user.update', $id) : route('admin.user.save') }}" id="userForm" method="post" enctype="multipart/form-data">

            @csrf

            <div class="row mb-4">

                {{-- thumb --}}
                <div class="col-md-3">
                    <div class="img-placeholder img-file-input {{ !empty( $avatar ) ? 'has-img' : '' }}">
                        <div 
                            class="wrapper" 
                            @php
                                echo !empty( $avatar ) ? 'style="background-image: url(' . $avatar . ');"' : ''
                            @endphp
                        >
                            <label>
                                <i class="fas fa-image fa-4x"></i>
                                <input type="file" accept=".jpeg,.jpg,.png" name="avatar_file">
                            </label>
                        </div>
                        <div class="btn remove"><i class="fas fa-times"></i></div>
                    </div>
                </div>

                <div class="col-md-9 d-flex flex-column">

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Username --}}
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $username }}" maxlength="255" {{ isset( $id ) ? 'readonly' : 'required'}}>
                            </div>  
                        </div>

                        <div class="col-md-6">
                            {{-- Email --}}
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required value="{{ $email }}" maxlength="255">
                            </div>  
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Name --}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required value="{{ $name }}" maxlength="255">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-select form-control" name="role" required>
                                    <option value="">--- Select Role ---</option>
                                    <option value="user" {{ $role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Password --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" maxlength="255" minlength="8" {{ isset( $id ) ? '' : 'required' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" maxlength="255" minlength="8" {{ isset( $id ) ? '' : 'required' }}>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text text-center flex-grow-1">Save</span>
                    </button>

                    @if (isset($id))
                        <a 
                            class="btn btn-danger btn-icon-split"
                            onclick="appUtils.deleteModal(
                                'User',
                                '{{ $username }}',
                                '{{ route('admin.user.delete', $id) }}'
                            )"
                        >
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text text-center flex-grow-1">Delete</span>
                        </a>
                    @endif
                    
                </div>
            </div>
            

        </form>
    </div>

    <script>
        jQuery(function($){

            let $userForm = $('#userForm');

            let $inputFileThumb = $userForm.find('input[name="avatar_file"]');

            $inputFileThumb.on('change', function(){

                let $this = $(this),
                    $wrapper = $this.parents('.wrapper'),
                    $placeholder = $this.parents('.img-placeholder');

                let _URL = window.URL || window.webkitURL; 

                if(this.files.length) {
                    $placeholder.addClass('has-img');
                    $wrapper.css('background-image', `url('${_URL.createObjectURL(this.files[0])}')`);
                } else {
                    $placeholder.removeClass('has-img');
                    $wrapper.css('background-image', '');
                }
            })

            $userForm.find('.btn.remove').on('click', function(){
                $inputFileThumb.val('').trigger('change');
            })
        })
    </script>
</div>