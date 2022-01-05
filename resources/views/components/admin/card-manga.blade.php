@push('headerScripts')
    <link href="/assets/vendor/select2.min.css" rel="stylesheet" />
    <link href="/assets/vendor/select2-bootstrap.css" rel="stylesheet" />
    <script src="/assets/vendor/select2.min.js"></script>
@endpush

{{-- CHAPTER LIST CARD --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manga Details</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('ajax.manga.save') }}" id="mangaForm" method="post" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="id" value={{ isset( $id ) ? $id : '' }}>

            <div class="row mb-4">

                {{-- thumb --}}
                <div class="col-md-3">
                    <div class="img-placeholder img-file-input {{ !empty( $thumbnail ) ? 'has-img' : '' }}">
                        <div class="wrapper" @php
                            echo !empty( $thumbnail ) ? 'style="background-image: url(' . $thumbnail . ');"' : ''
                        @endphp>
                            <label>
                                <i class="fas fa-image fa-4x"></i>
                                <input type="file" accept=".jpeg,.jpg,.png" name="thumbnail" {{ !empty( $thumbnail ) ? '' : 'required' }} >
                            </label>
                        </div>
                        <div class="btn remove"><i class="fas fa-times"></i></div>
                    </div>
                </div>

                <div class="col-md-9 d-flex flex-column">

                    {{-- title --}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required value="{{ $title }}" maxlength="150">
                    </div>   

                    {{-- summary --}}
                    <div class="form-group flex-grow-1 d-flex flex-column mb-0">
                        <label>Summary</label>
                        <textarea type="text" class="form-control flex-grow-1" name="summary">{{ $summary }}</textarea>
                    </div>   
                    
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">
                        <label>Publish Status</label>
                        <select name="publish_status" id="" class="form-control">
                            <option value="published" {{ $publishStatus == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="pending" {{ $publishStatus == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>  

                    <div class="form-group">
                        <label>Publish Time</label>
                        <input type="datetime-local" class="form-control" value="{{ $publishTime }}" name="published_at">
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
                                    <option value="ongoing" {{ $releaseStatus == 'ongoing' ? 'selected' : '' }}>On Going</option>
                                    <option value="end" {{ $releaseStatus == 'end' ? 'selected' : '' }}>End</option>
                                    <option value="completed" {{ $releaseStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Release Year</label>
                                <select name="year" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'year')}}">
                                    @if (isset($year))
                                        <option value="{{ $year }}" selected>{{ $year }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="form-group">
                        <label>Categories</label>
                        <select name="categories[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'category')}}" multiple>
                            @if (isset($categories) && is_array($categories))
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" selected>{{ $category }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- TAG --}}
                    <div class="form-group">
                        <label>Tags</label>
                        <select name="tags[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'tag') }}" multiple>
                            @if (isset($tags) && is_array($tags))
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>  

                    {{-- AUTHOR --}}
                    <div class="form-group">
                        <label>Authors</label>
                        <select name="authors[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'author') }}" multiple>
                            @if (isset($authors) && is_array($authors))
                                @foreach ($authors as $author)
                                    <option value="{{ $author }}" selected>{{ $author }}</option>
                                @endforeach
                            @endif
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

                    @if (isset($id))

                        <a class="btn btn-primary btn-icon-split" href="{{ route('manga.view', $slug) }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="text text-center flex-grow-1">View</span>
                        </a>

                        <a 
                            class="btn btn-danger btn-icon-split"
                            onclick="aCommon.deleteModal(
                                'Manga',
                                '{{ $title }}',
                                '{{ route('admin.manga.delete', $id) }}'
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
            
            $(".select2-tags").each((i, e) => {
                let $this = $(e);
                $this.select2({
                    tags: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: $this.data('ajax-url'),
                        data: function (params) {

                            var query = {
                                search: params.term,
                                page: params.page || 1,
                                selected: $this.val()
                            }

                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        }
                    }
                });
            })

            let $mangaForm = $('#mangaForm');

            // $mangaForm.on('submit', function(e){
            //     e.preventDefault();

            //     let form = this, 
            //         $form = $(this), 
            //         $card = $form.parents('.card')
            //         $input = $form.find('input'),
            //         fd = new FormData(form);

            //     $.ajax({
            //         url: `${$form.attr('action')}?_token=${fd.get('_token')}`,
            //         method: $form.attr('method'),
            //         processData: false,
            //         data: new FormData(form),
            //         beforeSend() {
            //             $input.prop('disabled', true);
            //             aCommon.appendLoading($card);
            //         },
            //         success(resp) {
            //             aCommon.alert(resp.msg, resp.error ? 'error' : 'success');
            //         },
            //         complete(xhr, stt, err) {
            //             $input.prop('disabled', false);
            //             aCommon.removeLoading($card);

            //             if(xhr.status !== 200) {
            //                 aCommon.alert(`ERROR ${xhr.status}: Something wrong occured`, 'error');
            //             }
            //         }
            //     })
            // })

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