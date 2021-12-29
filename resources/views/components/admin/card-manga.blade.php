{{-- CHAPTER LIST CARD --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manga Details</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('ajax.manga.save') }}" id="mangaForm" method="post">

            @csrf

            <input type="hidden" name="manga_id">

            <div class="row mb-4">

                {{-- thumb --}}
                <div class="col-md-3">
                    <div class="img-placeholder img-file-input">
                        <div class="wrapper">
                            <label>
                                <i class="fas fa-image fa-4x"></i>
                                <input type="file" accept=".jpeg,.jpg,.png" required name="thumbnail">
                            </label>
                        </div>
                        <div class="btn remove"><i class="fas fa-times-circle"></i></div>
                    </div>
                </div>

                <div class="col-md-9 d-flex flex-column">

                    {{-- title --}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>   

                    {{-- summary --}}
                    <div class="form-group flex-grow-1 d-flex flex-column mb-0">
                        <label>Summary</label>
                        <textarea type="text" class="form-control flex-grow-1" name="summary"></textarea>
                    </div>    
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">
                        <label>Publish Status</label>
                        <select name="publish_status" id="" class="form-control">
                            <option value="published">Published</option>
                            <option value="pending">Draft</option>
                        </select>
                    </div>  

                    <div class="form-group">
                        <label>Publish Time</label>
                        <input type="datetime-local" class="form-control" value="">
                    </div>  

                    <div class="form-group">
                        <a href="javascript:void(0)" class="btn btn-info btn-icon-split d-flex justify-content-start mb-2" data-toggle="tooltip" data-placement="top" title="Manga must be saved first">
                            <span class="icon text-white-50">
                                <i class="fas fa-th-list"></i>  
                            </span>
                            <span class="text text-center flex-grow-1">Edit Chapters List</span>
                        </a>
                    </div>

                </div>

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Release Status</label>
                                <select name="release_status" id="" class="form-control">
                                    <option value="ongoing">On Going</option>
                                    <option value="end">End</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Release Year</label>
                                <select name="release_year" id="" class="form-control">
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Categories</label>
                        <select name="categories" id="" class="form-control">
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tags</label>
                        <select name="tags" id="" class="form-control">
                            
                        </select>
                    </div>  

                    <div class="form-group">
                        <label>Authors</label>
                        <select name="authors" id="" class="form-control">
                            
                        </select>
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

                    <button type="submit" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text text-center flex-grow-1">Delete</span>
                    </button>
    
                    
                </div>
            </div>
            

        </form>
    </div>

    <script>
        jQuery(function($){

            let $mangaForm = $('#mangaForm');

            $mangaForm.on('submit', function(e){
                e.preventDefault();

                let form = this, 
                    $form = $(this), 
                    $card = $form.parents('.card')
                    $input = $form.find('input'),
                    fd = new FormData(form);

                $.ajax({
                    url: `${$form.attr('action')}?_token=${fd.get('_token')}`,
                    method: $form.attr('method'),
                    processData: false,
                    data: new FormData(form),
                    beforeSend() {
                        $input.prop('disabled', true);
                        aCommon.appendLoading($card);
                    },
                    success(resp) {
                        aCommon.alert(resp.msg, resp.error ? 'error' : 'success');
                    },
                    complete(xhr, stt, err) {
                        $input.prop('disabled', false);
                        aCommon.removeLoading($card);

                        if(xhr.status !== 200) {
                            aCommon.alert(`ERROR ${xhr.status}: Something wrong occured`, 'error');
                        }
                    }
                })
            })

            let $inputThumb = $mangaForm.find('input[name="thumbnail"]');
            $inputThumb.on('change', function(){
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

            $mangaForm.find('.btn.remove').on('click', function(){
                $inputThumb.val('').trigger('change');
            })
        })
    </script>
</div>